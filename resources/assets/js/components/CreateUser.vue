<template lang="html">

    <div class="novo-user panel panel-primary">
      <div class="panel-heading">
        <h3>Create User</h3>
      </div>
      <div class="panel-body">
        <form @submit.prevent="submitForm" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <input type="text" name="name" class="form-control title" placeholder="Name">
            </div>
            <div class="form-group">
              <input type="text" name="email" class="form-control title" placeholder="Email">
            </div>
            <div class="form-group">
              <input type="password" name="password" class="form-control title" placeholder="Password">
            </div>
            <div class="form-group">
                <div v-if="!image" class="">
                  <h3>Select an image</h3>
                </div>
                <div class="box-img" v-else>
                  <img :src="image" />
                  <button class="btn btn-sm btn-default" @click="removeImage">Remove Imagem</button>
                </div>
                <input type="file" name="image" @change="onFileChange">
            </div>
            <div class="panel-footer">
              <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
      </div>
    </div>
</template>

<script>
export default {
    data(){
      return{
        image: ''
      }
    },
    methods:{
      onFileChange(e){
        var files = e.target.files || e.dataTransfer.files;
        if(!files.length)
        return;
        this.createImage(files[0]);
      },
      createImage(file){
        var image = new Image();
        var reader = new FileReader();
        var vm = this;
        reader.onload = (e) => {
          vm.image = e.target.result;
        };
        reader.readAsDataURL(file);
      },
      removeImage: function (e) {
        this.image = '';
      },
      submitForm: function(){
        var form = document.querySelector('form');
        var formdata = new FormData(form);
        this.$http.post('api/submit', formdata)
          .then((response) => {
            
              this.$router.push({path: '/', query: { alert: response.body.message}})
          }, (response) => {
            //error
            console.log('Error'+response);

          });
      }

    }
}
</script>

<style lang="css">
.novo-user{
  width: 600px;
  /*margin: 0 auto;*/
}
.box-rm{
  padding: 5px;
  margin-bottom: 5px;
}
.novo-user img{
  width: 30%;
  /*margin: auto;*/
  display: block;
  margin-bottom: 10px;
}
</style>
