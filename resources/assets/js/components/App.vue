<template>
  <div id="app">
    <div class="heading">
      <h1>Users</h1>
    </div>
    <crud-component
      v-for="user in users"
      v-bind="user"
      :key="user.id"
      @update="update"
      @delete="del"
    ></crud-component>
    <div>
      <button @click="create()">Add User</button>
    </div>
  </div>
</template>

<script>
  function Crud({ id, name}) {
    this.id = id;
    this.name = name;
  }

  import CrudComponent from './CrudComponent.vue';

  export default {
    data() {
      return {
        cruds: [],
        mute: false
      }
    },
    methods: {
      create() {
        this.mute = true;
        window.axios.get('/api/cruds/create').then(({ data }) => {
          this.cruds.push(new Crud(data));
          this.mute = false;
        });
      },
      read() {
        this.mute = true;
        window.axios.get('/api/cruds').then(({ data }) => {
          data.forEach(crud => {
            this.cruds.push(new Crud(crud));
          });
          this.mute = false;
        });
      },
      update(id, color) {
        this.mute = true;
        window.axios.put(`/api/cruds/${id}`, { name }).then(() => {
          this.cruds.find(crud => crud.id === id).name = name;
          this.mute = false;
        });
      },
      del(id) {
        this.mute = true;
        window.axios.delete(`/api/cruds/${id}`).then(() => {
          let index = this.cruds.findIndex(crud => crud.id === id);
          this.cruds.splice(index, 1);
          this.mute = false;
        });
      }
    },
    components: {
      CrudComponent
    },
    created() {
      this.read();
    }.
    watch: {
      mute(val) {
        document.getElementById('mute').className = val ? "on" : "";
      }
    }
  }
</script>
