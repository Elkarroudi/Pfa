
    import URL from "../constants/Api.js";
    let data = JSON.parse(localStorage.getItem('mc_jobs'));



    export async function getBookmark(adminData) {
        let response = await fetch(`${URL}/v1/bookmark/all`, {
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
            adminData.bookmarks = response.data;
            return true;
        }
    }

    export async function deleteBookmark(adminData, id, index) {
        let response = await fetch(`${URL}/v1/bookmark/delete/${id}`, {
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
            adminData.bookmarks.splice(index, 1);
            return true;
        }
    }

    export async function addBookmark(id) {
        let response = await fetch(`${URL}/v1/bookmark/create/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify({listing_id: id}),
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            return true;
        }
    }

    export async function addApplications(id) {
        let response = await fetch(`${URL}/v1/application/create/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify({listing_id: id}),
        }).then(response => response.json());

        if (!response.status)
        {
            console.log(response.errors);
            return false;
        }

        else {
            return true;
        }
    }

    export async function getApplications(adminData) {
        let response = await fetch(`${URL}/v1/application/all/`, {
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

    export async function deleteApplication(adminData, id, index) {
        let response = await fetch(`${URL}/v1/application/delete/${id}`, {
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
            adminData.applications.splice(index, 1);
            return true;
        }
    }

    export async function getEducations(seekerData) {
        let response = await fetch(`${URL}/v1/education/all/`, {
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
            seekerData.educations = response.data;
            return true;
        }
    }


    export async function createEducations(educations, seekerData, errors ) {
        let response = await fetch(`${URL}/v1/education/create/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify(educations),
        }).then(response => response.json());

        if (!response.status)
        {
            errors.content = response.errors;
            return false;
        }

        else {
            seekerData.educations.push(response.data);
            return true;
        }
    }


    export async function deleteEducations(adminData, id, index) {
        let response = await fetch(`${URL}/v1/education/delete/${id}`, {
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
            adminData.educations.splice(index, 1);
            return true;
        }
    }

    export async function updateEducations(education, seekerData, errors, id, index) {
        let response = await fetch(`${URL}/v1/education/update/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify(education),
        }).then(response => response.json());

        if (!response.status)
        {
            errors.update = response.errors;
            return false;
        }

        else {
            seekerData.educations[index] = response.data;
            return true;
        }
    }

    export async function getExperiences(seekerData) {
        let response = await fetch(`${URL}/v1/experience/all/`, {
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
            seekerData.experiences = response.data;
            return true;
        }
    }

    export async function createExperience(experience, seekerData, errors ) {
        let response = await fetch(`${URL}/v1/experience/create/`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify(experience),
        }).then(response => response.json());

        if (!response.status)
        {
            errors.content = response.errors;
            return false;
        }

        else {
            seekerData.experiences.push(response.data);
            return true;
        }
    }

    export async function deleteExperience(seekerData, id, index) {
        let response = await fetch(`${URL}/v1/experience/delete/${id}`, {
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
            seekerData.experiences.splice(index, 1);
            return true;
        }
    }

    export async function updateExperience(experience, seekerData, errors, id, index) {
        let response = await fetch(`${URL}/v1/experience/update/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            },
            body: JSON.stringify(experience),
        }).then(response => response.json());

        if (!response.status)
        {
            errors.update = response.errors;
            return false;
        }

        else {
            seekerData.experiences[index] = response.data;
            return true;
        }
    }