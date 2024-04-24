
<script>

    export default {
      name: "Users",
      props: {
        data: { type: Object, required: true, },
      },
    }
  </script>

  <template>
    <table class="w-full border-2 border-gray-500" >
      <thead>
      <tr>
        <td class="font-[800]" >index</td>
        <td class="font-[800]" >user data</td>
        <td class="font-[800]" >username</td>
        <td class="font-[800]" >role</td>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(user, index) in data" >
        <td><span class="bg-yellow-500 px-2 py-2 rounded" >{{ index + 1 }}</span></td>
        <td>
          <div class="flex flex-col" >
            <span><span class="bg-yellow-500 px-2 rounded" >name :</span> {{ user.name.toLowerCase() }}</span>
            <span><span class="bg-yellow-500 px-2 rounded" >email :</span> {{ user.email.toLowerCase() }}</span>
          </div>
        </td>
        <td><span><span class="bg-yellow-500 px-2 rounded" >username :</span> {{ user.username.toLowerCase() }}</span></td>
        <td>
          <span v-if="user.type === 'Admin'" class="role bg-red-500 rounded" >{{ user.type.toLowerCase() }}</span>
          <span v-if="user.type === 'Job Seeker'" class="role bg-blue-500 rounded" >{{ user.type.toLowerCase() }}</span>
          <span v-if="user.type === 'Recruiter'" class="role bg-green-500 rounded" >{{ user.type.toLowerCase() }}</span>
        </td>
      </tr>
      </tbody>
    </table>
  </template>

  <style>
    td {
      border: 2px solid #000;
      padding: 5px 10px 3px 10px;
    }
    thead tr {
      background-color: #000;
      color: #fff;
      font-size: 20px;
    }
    table .role {
      padding: 5px;
      color: white;
    }
  </style>
