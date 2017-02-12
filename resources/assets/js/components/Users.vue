<template lang="html">
    <div class="">
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>
                #
              </th>
              <th>Username</th>
              <th>Email</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in users">
              <td>
                <img :src="user.photo ? user.photo.file: 'images/default-profile.png' " alt="" width="40px" />
              </td>
              <td>
                {{user.name}}
              </td>
              <td>
                {{user.email}}
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
           this.users = response.data.users
          // console.log(response.body.users);
        })
      }
    }
}
</script>

<style lang="css">
</style>
