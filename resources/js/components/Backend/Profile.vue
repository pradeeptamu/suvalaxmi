<style>
    .widget-user-header{
        background-position: center center;
        background-size: cover;
        height: 250px !important;
    }
    .widget-user .card-footer{
        padding: 0;
    }
</style>


<template>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
                <div class="card card-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header text-white">
                        <h3 class="widget-user-username" style="color: black">{{this.form.name}}</h3>
                        <h5 class="widget-user-desc">{{this.form.type}}</h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" :src="getProfilePhoto()" alt="User Avatar">
                    </div>
                </div>
            </div>

            <!-- tab -->

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Activity</a></li>
                            <li class="nav-item"><a class="nav-link active show" href="#settings" data-toggle="tab">Settings</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Display User Activity</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <label for="inputName" class="col-sm-2 control-label">Name</label>

                                        <div class="col-sm-12">
                                            <input type="" v-model="form.name" class="form-control" id="inputName" placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                        <div class="col-sm-12">
                                            <input type="email" v-model="form.email" class="form-control" id="inputEmail" placeholder="Email"  :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-12">
                                        <input v-model="form.phone" type="text" name="phone" placeholder="Enter Phone"
                                               class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                                            <has-error :form="form" field="phone"></has-error></div>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                        <div class="col-sm-12">
                                            <textarea  v-model="form.bio" class="form-control" id="inputExperience" placeholder="Experience" :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="photo" class="col-sm-2 control-label">Profile Photo</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="updateProfile" name="photo" id="photo" class="form-input">
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="password" class="col-sm-12 control-label">Password (leave empty if not changing)</label>

                                        <div class="col-sm-12">
                                            <input type="password"
                                                   v-model="form.password"
                                                   class="form-control"
                                                   id="password"
                                                   placeholder="Password"
                                                   :class="{ 'is-invalid': form.errors.has('password') }"
                                            >
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-12">
                                            <button @click.prevent="updateInfo" type="submit" class="btn btn-success">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- end tabs -->
        </div>
    </div>
</template>



<script>
    export default {
        data(){
            return {
                form: new Form({
                    id:'',
                    name : '',
                    email: '',
                    password: '',
                    type: '',
                    address:'',
                    bio: '',
                    photo: '',
                    phone:''
                })
            }
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods:{
            getProfilePhoto(){
                let photo = (this.form.photo.length > 200) ? this.form.photo : "/img/"+ this.form.photo ;
                //old photo naming convention is timestamp less than 200
                //if new photo then puts base 64
                //constantly update image when changed in input file..

                return photo;
            },
            updateInfo(){
                this.$Progress.start();
                if(this.form.password == ''){
                    this.form.password = undefined;
                }
                this.form.put('/api/profile')
                    .then(()=>{
                        this.$emit('AfterCreate');
                        this.$Progress.finish();
                        swal.fire(
                            'Updated!',
                            'Information has been updated.',
                            'success'
                        )
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    });
            },
            updateProfile(e){
                //using base64 for converting image into text and vice versa
                let file = e.target.files[0];
                let reader = new FileReader();
                let limit = 1024 * 1024 * 2;
                if(file['size'] > limit){
                    swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: 'You are uploading a large file',
                    })
                    return false;
                }
                reader.onloadend = (file) => {
                    this.form.photo = reader.result;
                    //stores image in format of text
                }
                reader.readAsDataURL(file);
            }
        },
        created() {

            axios.get("/api/profile/"+this.$store.getters.currentAdmin.id)
                .then(({ data }) => (this.form.fill(data)));
        }
    }
</script>