
    import URL from "../constants/Api.js";
    let data = JSON.parse(localStorage.getItem('mc_jobs'));

    export async function getRecruiterListings(listing) {
        let response = await fetch(`${URL}/v1/listing/all/`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`,
            },
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response);
            return false;
        }

        else
        {
            listing.content = response.data;
            return true;
        }
    }

    export async function deleteListing(listings, id) {
        let response = await fetch(`${URL}/v1/listing/delete/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            const index = listings.findIndex(listing => listing.id === id);
            listings.splice(index, 1);
            return true;
        }
    }

    export async function getCompanies(adminData) {
        let response = await fetch(`${URL}/v1/recruiter/company/all/`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            adminData.companies = response.data;
            return true;
        }
    }

    export async function createNewListing(errors, listingData, listings) {
        let response = await fetch(`${URL}/v1/listing/create/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify(listingData),
        }).then(response => response.json());

        if (!response.status)
        {
            errors.content = response.errors;
            return false;
        }

        else {
            errors.content = [];
            console.log(response.data);
            listings.push(response.data);
            return true;
        }
    }

    export async function getApplications(adminData) {
        let response = await fetch(`${URL}/v1/recruiter/application/all/`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            adminData.applications = response.data;
            return true;
        }
    }

    export async function changeStatus(status, id, listings) {
        let response = await fetch(`${URL}/v1/recruiter/application/${status}/${id}/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            for (let i = 0; i < listings.length; i++) {
                for (let j = 0; j < listings[i].applications.length; j++) {
                    if (listings[i].applications[j].id === id) {
                        listings[i].applications[j].status = status;
                    }
                }
            }
            return true;
        }
    }

    export async function getStatistics(adminData) {
        let response = await fetch(`${URL}/v1/recruiter/statistics/`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            adminData.statistics = response.data;
            return true;
        }
    }

    export async function updateListing(errors, listingData, id, listings, index) {
        let response = await fetch(`${URL}/v1/listing/update/${id}/`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify(listingData),
        }).then(response => response.json());

        console.log(response);
        if (!response.status)
        {
            errors.content = response.errors;
            return false;
        }

        else {
            errors.content = [];
            listings[index] = response.data;
            return true;
        }
    }



