<template lang="html">
    <div class="">
        <table>
          <thead>
            <tr>
              <th>Username</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users">
              <td>
                {{User.name}}
              </td>
              <td>
                {{User.email}}
              </td>
            </tr>
          </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data(){
      return{
        users: []
      }

    },
    created(){
        this.fetchUsers();
    },
    methods:{
      fetchUsers(){
        this.$http.get('api/users').then(response => {
          this.users = response.data.users;
        })
      }
    }
}
</script>

<style lang="css">
</style>
