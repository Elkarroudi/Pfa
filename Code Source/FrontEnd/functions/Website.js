
    import URL from "../constants/Api.js";


    export async function getListings(adminData) {
        let response = await fetch(`${URL}/v1/public/listing/all`, {
            method: 'GET',
            headers: {'Content-Type': 'application/json',},
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            adminData.listings = response.data;
            return true;
        }
    }

    export async function searchJObs(search, webData) {
        let response = await fetch(`${URL}/v1/public/search/`, {
            method: 'POST',
            headers: {'Content-Type': 'application/json'},
            body: JSON.stringify(search),
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            webData.listings = response.data;
            return true;
        }
    }

    export async function getCompanies(adminData) {
        let response = await fetch(`${URL}/v1/public/company/`, {
            method: 'GET',
            headers: {'Content-Type': 'application/json',},
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

    export async function getListingData(adminData, id) {
        let response = await fetch(`${URL}/v1/public/listing/${id}`, {
            method: 'GET',
            headers: {'Content-Type': 'application/json',},
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            adminData.listing = response.data;
            return true;
        }
    }