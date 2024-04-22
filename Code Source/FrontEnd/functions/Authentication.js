
  import URL from "../constants/Api.js";
  let data = JSON.parse(localStorage.getItem('mc_jobs'));


  export async function login(credentials, errors) {
    let response = await fetch(`${URL}/v1/auth/login/`, {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(credentials),
    }).then(response => response.json());

    if (!response.status)
    {
      errors.content = response.errors;
      return false;
    }

    else
    {
      errors.content = [];
      localStorage.removeItem('mc_jobs');
      localStorage.setItem('mc_jobs', JSON.stringify({
        accessToken: response.data.token,
        registrationDate: new Date().toISOString(),
        expirationDate: new Date(Date.now() + 3600 * 1000).toISOString(),
      }));
      return true;
    }
  }

  export async function register(userData, errors) {
    let response = await fetch(`${URL}/v1/auth/register/${userData.type}`, {
      method: 'POST',
      headers: {'Content-Type': 'application/json'},
      body: JSON.stringify(userData),
    }).then(response => response.json());
    if (!response.status)
    {
      errors.content = response.errors;
      return false;
    }

    else { return true; }
  }

  export async function logout() {
    let response = await fetch(`${URL}/v1/auth/logout/`, {
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

    else { console.log(response); return true; }
  }

  export function checkUserType(data, userProfile) {

    if (data.userType === 'Job Seeker')
    { return userProfile.link = '/seeker/profile/'; }

    else if (data.userType === 'Recruiter')
    { return userProfile.link = '/recruiter/profile/'; }

  }

  export async function getUserData(user) {
    let response = await fetch(`${URL}/v1/auth/profile/`, {
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
      user.data = response;
      return true;
    }
  }

