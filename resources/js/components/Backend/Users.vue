<template>
    <div class="container">
        <div class="row mt-5" >
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Users Table</h3>

                        <div class="card-tools">
                            <button class="btn btn-success" data-toggle="modal" data-target="#addNew" @click="newModal">Add New <i
                                    class="fas fa-user-plus fa-fw"></i></button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Type</th>
                                <th>Phone</th>
                                <th>Registered At</th>
                                <th>Modify</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="user in users.data" :key="user.id">
                                <td>{{user.id}}</td>
                                <td>{{user.name}}</td>
                                <td>{{user.email}}</td>
                                <td>{{user.type}}</td>
                                <td>{{user.phone}}</td>
                                <td>{{user.created_at}}</td>
                                <td>
                                    <a href="#" @click="editModal(user)">
                                        <i class="fa fa-edit blue"></i>
                                    </a>
                                    <a href="#" @click="deleteUser(user.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        <pagination :data="users" @pagination-change-page="getResults"></pagination>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="addNewLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-show="!editMode" id="addNewLabel">Add New</h5>
                        <h5 class="modal-title" v-show="editMode" id="addNewLabel">Update User's Info</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form @submit.prevent="editMode? updateUser():createUser()">
                        <div class="modal-body">
                            <div class="form-group">
                                <input v-model="form.name" type="text" name="name" placeholder="Enter Name"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.email" type="email" name="email" placeholder="Enter Email"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.phone" type="text" name="phone" placeholder="Enter Phone"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                <has-error :form="form" field="phone"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.address" type="text" name="address" placeholder="Enter Address"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('address') }">
                                <has-error :form="form" field="address"></has-error>
                            </div>
                            <div class="form-group">
                            <textarea v-model="form.bio" type="text" name="bio"
                                      placeholder="Short bio for User(Description optional)"
                                      class="form-control" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                <has-error :form="form" field="bio"></has-error>
                            </div>
                            <div class="form-group">
                                <select v-model="form.type" type="text" name="type" placeholder="Enter type"
                                        class="form-control" :class="{ 'is-invalid': form.errors.has('type') }">
                                    <option value="" selected disabled>Select User Role</option>
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="author">Author</option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                            <div class="form-group">
                                <input v-model="form.password" type="password" name="password"
                                       placeholder="Enter password"
                                       class="form-control" :class="{ 'is-invalid': form.errors.has('password') }">
                                <has-error :form="form" field="password"></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i
                                    class="fas fa-times-circle"></i></button>
                            <button type="submit" v-show="!editMode" class="btn btn-primary">Create <i class="fas fa-plus-circle"></i>
                            </button>
                            <button type="submit" v-show="editMode" class="btn btn-primary">Update <i class="fas fa-plus-circle"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                editMode:false,
                users: {},
                form: new Form({
                    id:'',
                    name: '',
                    email: '',
                    password: '',
                    type: '',
                    bio: '',
                    photo: '',
                    phone:'',
                    address:''
                })
            }
        },
        created() {
            // this.$store.dispatch('setComponentName','Users');
            // Fire.$on('searchUser',() => {
            //     let query = this.$parent.search;
            //      axios.get('/api/findUser?q=' + query)
            //         .then((data) => {
            //             this.users = data.data;
            //         })
            //         .catch(() => {
            //
            //         })
            // });
           this.loadUsers();
           this.$on('AfterCreate',()=>{
              this.loadUsers();
           });
        },
        methods: {
            getResults(page = 1) {
                axios.get('/api/user?page=' + page)
                    .then(response => {
                        this.users = response.data;
                    });
            },
            updateUser(){
              this.$Progress.start();
                this.form.put('/api/user/'+this.form.id)
                  .then((id)=>{
                      //success
                      $('#addNew').modal('hide');
                      swal.fire(
                          'Updated!',
                          'Information has been updated.',
                          'success'
                      )
                      this.$Progress.finish();
                      this.$emit('AfterCreate');
                  })
                  .catch(()=>{
                      //fail
                      this.$Progress.fail();//changes the color of vue progress bar
                  })
            },
            //two modal for edit and add
            newModal(){
                this.editMode=false;
                this.form.reset();//clears the form
                $('#addNew').modal('show');
            },
            editModal(user){
                this.editMode=true;
                this.form.reset();

                this.form.fill(user);
                $('#addNew').modal('show');
            },
            loadUsers() {
                    axios.get("/api/user").then(({data}) => (this.users = data));
            },
            createUser() {
                this.$Progress.start();
                this.form.post('/api/user')
                    .then(()=>{
                        this.$emit('AfterCreate');
                        $('#addNew').modal('hide');
                        Toast.fire({
                            type: 'success',
                            title: 'User Created Successfully !!!'
                        });
                        this.$Progress.finish();
                    })
                    .catch(()=>{
                    })
            },
            deleteUser(id){
                swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    // Send request to the server
                    if (result.value) {
                        this.form.delete('/api/user/'+id).then(()=>{
                            swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                            this.$emit('AfterCreate');
                        }).catch(()=> {
                            swal("Failed!", "There was something wrong.", "warning");
                        });
                    }
                })
            }//end of deleteUser
        }
    }
</script>
