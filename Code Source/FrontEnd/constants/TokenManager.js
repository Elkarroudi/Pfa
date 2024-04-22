
    import URL from "./Api.js";

    function checkTokenIfExists() {
        if (localStorage.getItem('mc_jobs')) { return true; }
        return false;
    }

    async function checkTokenValidity() {
        let data = JSON.parse(localStorage.getItem('mc_jobs'));
        let response = await fetch(`${URL}/v1/auth/check/`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'Authorization': `bearer ${data.accessToken}`
            }
        }).then(response => response.json());

        if (!response.status)
        {
            localStorage.removeItem('mc_jobs');
            return { status: false, };
        }

        else
        {
            return {
                status: true,
                userType: response.userType,
            };
        }
    }

    async function check() {
        if (checkTokenIfExists())
        { return await checkTokenValidity(); }

        return { status: false, };
    }

    export default check;