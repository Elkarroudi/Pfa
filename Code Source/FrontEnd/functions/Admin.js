
    import URL from "../constants/Api.js";
    let data = JSON.parse(localStorage.getItem('mc_jobs'));


    export async function getStatistics(adminData) {
        let response = await fetch(`${URL}/v1/admin/statistics/`, {
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

    export async function getUsers(adminData) {
        let response = await fetch(`${URL}/v1/admin/users/`, {
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
            adminData.users = response.data;
            return true;
        }
    }

    export async function getCompanies(adminData) {
        let response = await fetch(`${URL}/v1/company/all/`, {
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

    export async function deleteCompany(companies, id) {
        let response = await fetch(`${URL}/v1/company/delete/${id}`, {
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
            const index = companies.findIndex(company => company.id === id);
            companies.splice(index, 1);
            return true;
        }
    }

    export async function createNewCompany(errors, companyData) {
        let response = await fetch(`${URL}/v1/company/create/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify(companyData),
        }).then(response => response.json());

        if (!response.status)
        {
            errors.content = response.errors;
            return false;
        }

        else {
            errors.content = [];
            return true;
        }
    }

    export async function getListing(adminData) {
        let response = await fetch(`${URL}/v1/admin/listing/all/`, {
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
            adminData.content = response.data;
            return true;
        }
    }

    export async function changeStatus(status, id, index, listings) {
        let response = await fetch(`${URL}/v1/admin/listing/${status}/${id}/`, {
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
            listings[index].status = status;
            return true;
        }
    }



