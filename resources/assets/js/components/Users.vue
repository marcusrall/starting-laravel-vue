<template lang="html">
    <div class="panel panel-default user-index">

        <div class="panel-heading">Lista de Usuarios</div>
        <button v-if="users.length > 0" class="btn btn-danger btn-lg" @click="destroySubmit">Deletar</button>
            <div class="panel-body">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>
                      #
                    </th>
                    <th>
                      Foto
                    </th>
                    <th>Username</th>
                    <th>Email</th>

                  </tr>
                </thead>

                <tbody>
                  <tr v-for="user in users">
                    <td>
                      <input type="checkbox" @click="user.completed = !user.completed" :value = "user.id" v-model="checkedNames">
                    </td>
                    <td>
                      <img :src="user.photo ? 'images/'+user.photo.file : '/images/default-profile.png' " alt="" width="40px" />
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
    </div>
</template>

<script>
export default {
    data(){
      return{
        users: [],
        checkedNames: [],
        user:{
          complete: false
        },
        filters: {
          notDone: function(todo){
            return ! todo.completed;
          },
          completed: function(todo){
            return todo.completed;
          }

        }
      }

    },
    computed: {
      finished: function(){
        return this.task.filter(this.filters.completed);
      },
      pending: function(){
        return this.task.filter(this.filters.notDone);
      }
    },
    created(){
        this.fetchUsers();
    },
    methods:{
      fetchUsers(){
        this.$http.get('api/users').then(response => {
           this.users = response.data.users
          //  console.log(response.data.users);
        })
      },
      destroySubmit: function(){
        this.users = this.users.filter(this.filters.notDone);
        this.$http.post('api/user/destroy', {id: this.checkedNames })
        .then((response) => {

        }, (response) => {
          // error de callback
        });
      }
    }
}
</script>

<style lang="css">

.user-index .btn-danger{
  margin: 10px 10px 10px 15px;
}
</style>
