<template lang="html">
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button"class="close" data-dismiss="alert" aria-label="Close" name="button"><span aria-hidden="true">&times;</span></button>
        {{message}}
    </div>
</template>

<script>
export default {
  name: 'alert',
  props: ['message'],
  data (){
    return{

    }
  }
}
</script>

<style lang="css">
</style>
