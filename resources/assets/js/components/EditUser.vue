  <template lang="html">
  <div class="edit-user">
      <h1>Edit User</h1>
      <form @submit.prevent="updateForm" enctype="multipart/form-data">
          <div class="form-group">
              <input class="form-control title" type="text" name="name" placeholder="Name" v-model="user.name">
          </div>
          <div class="form-group">
              <input class="form-control title" type="text" name="email" placeholder="Email" v-model="user.email">
          </div>
          <div class="form-group">
              <input class="form-control title" type="password" name="password" placeholder="Password" v-model="user.password">
          </div>
          <div class="form-group">
              <div v-if="!image">
                  <h2>Select an image</h2>
              </div>
              <div v-else>
                  <img :src="image" alt="" />
                  <button @click="removeImage">Remover imagem</button>
              </div>
              <input type="file" name="image" @change="onFileChange">
          </div>
          <button type="submit" class="btn btn-primary">Editar</button>
      </form>
  </div>
</template>

<script>
export default {
  data(){
    return{
        image: '',
        user: {}
    }
  },
  methods:{

    fetchTask: function(id)
    {
      this.$http.get('api/users/'+ id).then(function (response){
        this.user = response.data;
      });
    },

    onFileChange(e)
    {
      var files = e.target.files || e.dataTransfer.files;
      if(!files.length)
      return;
      this.createImage(files[0]);
    },

    createImage(file)
    {
      var image = new Image();
      var reader = new FileReader();
      var vm = this;

      reader.onload = (e) => {
        vm.image = e.target.result;
      };

      reader.readAsDataURL(file);
    },

    removeImage: function(e)
    {
      this.image = '';
    },

    updateForm: function()
    {
      var form = document.querySelector('form');
      var formdata = new FormData(form);

      this.$http.post('api/users/' + this.$route.params.id, formdata)
      .then((response) => {
        this.$router.push({path: '/', query: {alert: response.message }})
      }, (response) => {
        console.log('error callback - Editar');
      });

    }
  },
  created:function()
  {
    this.fetchTask(this.$route.params.id);
  }
}
</script>

<style lang="css">
.edit-user img{
  width: 30%;
  /*margin: auto;*/
  display: block;
  margin-bottom: 10px;
}
</style>
