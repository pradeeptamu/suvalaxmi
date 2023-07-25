<template>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="tab-content">
                            <!-- Activity Tab -->
                            <div class="tab-pane" id="activity">
                                <h3 class="text-center">Display User Activity</h3>
                            </div>
                            <!-- Setting Tab -->
                            <div class="tab-pane active show" id="settings">
                                <form class="form-horizontal row d-flex justify-content-center">
                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputName" class="col-6 control-label">Name</label>
                                        <div class="col-sm-12">
                                            <input type="" v-model="form.name" class="form-control" id="inputName"
                                                placeholder="Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                            <has-error :form="form" field="name"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputEmail" class="col-6 control-label">Email</label>

                                        <div class="col-sm-12">
                                            <input type="email" v-model="form.email" class="form-control" id="inputEmail"
                                                placeholder="Email" :class="{ 'is-invalid': form.errors.has('email') }">
                                            <has-error :form="form" field="email"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputEmail" class="col-6 control-label">Phone</label>
                                        <div class="col-sm-12">
                                            <input type="text" v-model="form.phone" class="form-control" id="inputPhone"
                                                placeholder="Phone" :class="{ 'is-invalid': form.errors.has('phone') }">
                                            <has-error :form="form" field="phone"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                        <label for="inputExperience" class="col-6 control-label">Experience</label>

                                        <div class="col-sm-12">
                                            <textarea v-model="form.bio" class="form-control" id="inputExperience"
                                                placeholder="Experience"
                                                :class="{ 'is-invalid': form.errors.has('bio') }"></textarea>
                                            <has-error :form="form" field="bio"></has-error>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 col-md-6">
                                        <label for="photo" class="col-6 control-label">Profile Photo</label>
                                        <div class="col-sm-12">
                                            <input type="file" @change="updateProfile" name="photo" class="form-input"
                                                id="photo">
                                        </div>

                                    </div>

                                    <div class="form-group col-12 col-md-6">
                                        <label for="password" class="col-sm-12 control-label">Password (leave empty if
                                            not changing)</label>

                                        <div class="col-sm-12">
                                            <input type="password" v-model="form.password" class="form-control"
                                                id="password" placeholder="Password"
                                                :class="{ 'is-invalid': form.errors.has('password') }">
                                            <has-error :form="form" field="password"></has-error>
                                        </div>
                                    </div>

                                    <div class="form-group col-12 col-md-6 text-center mt-3">
                                        <button @click.prevent="updateInfo" type="submit" class="btn btn-success">
                                            Update
                                        </button>
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
import Form from 'vform'
export default {
    data() {
        return {
            form: new Form({
                id: this.$store.getters.currentUser.id,
                name: '',
                email: '',
                password: '',
                type: '',
                bio: '',
                photo: '',
                phone: ''
            })
        }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods: {
        getProfilePhoto() {
            let photo = (this.form.photo.length > 200) ? this.form.photo : "/img/profile/" + this.form.photo;
            //old photo naming convention is timestamp less than 200
            //if new photo then puts base 64
            //constantly update image when changed in input file..

            return photo;
        },
        updateInfo() {
            this.$Progress.start();
            if (this.form.password == '') {
                this.form.password = undefined;
            }
            this.form.put('/api/profile')
                .then(() => {
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
        updateProfile(e) {
            //using base64 for converting image into text and vice versa
            let file = e.target.files[0];
            let reader = new FileReader();
            let limit = 1024 * 1024 * 2;
            if (file['size'] > limit) {
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
        axios.get("/api/profile/" + this.$store.getters.currentUser.id)
            .then(({ data }) => (this.form.fill(data)));
    }
}
</script>

<style scoped>
button {
    padding: 0.5rem 4rem;
}

.widget-user-header {
    background-position: center center;
    background-size: cover;
    height: 250px !important;
}

.widget-user .card-footer {
    padding: 0;
}
</style>