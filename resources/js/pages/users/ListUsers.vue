<script setup>
import { onMounted, reactive, ref } from "vue";
import axios from "axios";

const users = ref([]);

const form = reactive({
    name:'',
    email:'',
    password: ''
})

const getUsers = () => {
  axios.get("/api/users").then((response) => {
    users.value = response.data;
  });
};

const createUser = () => {
    axios.post('/api/users', form).then((response)=>{
        form.name = '';
        form.email = '';
        form.password = '';
        $('#createUserModal').modal('hide')
    })
}

onMounted(() => {
  getUsers();
});
</script>

<template>
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Users</h1>
          <!-- Button trigger modal -->
          <button
            type="button"
            class="btn btn-primary mt-3"
            data-bs-toggle="modal"
            data-bs-target="#createUserModal"
          >
            Add New User
          </button>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="#">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="#">Users</a>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
  <div class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered">
            <head>
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Registered Date</th>
                <th>Role</th>
                <th>Options</th>
              </tr>
            </head>
            <tbody>
              <tr v-for="(user, index) in users" :key="user.id">
                <td>{{ index + 1 }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>---</td>
                <td>---</td>
                <td>---</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div
    class="modal fade"
    id="createUserModal"
    data-bs-backdrop="static"
    data-bs-keyboard="false"
    tabindex="-1"
    aria-labelledby="staticBackdropLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add New User</h1>
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label"
              >Name</label
            >
            <input
              type="text"
              v-model="form.name"
              class="form-control"
              id="name"
              placeholder="Name"
            />
          </div>
          <div class="mb-3">
            <label for="email" class="form-label"
              >Email</label
            >
            <input
              type="email"
              v-model="form.email"
              class="form-control"
              id="email"
              placeholder="Email"
            />
          </div>
          <div class="mb-3">
            <label for="password" class="form-label"
              >Password</label
            >
            <input
              type="password"
              v-model="form.password"
              class="form-control"
              id="password"
              placeholder="******"
            />
          </div>
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <button type="button" class="btn btn-primary" @click="createUser">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>