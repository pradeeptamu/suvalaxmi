<template>
    <div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Enquiries</h3>
                    </div>

                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(enquiry, index) in enquiries" :key="enquiry.id">
                                <td>{{ index+1 }}</td>
                                <td class="text-capitalize">{{ enquiry.name }}</td>
                                <td>{{ enquiry.email }}</td>
                                <td>{{ enquiry.mobile_number }}</td>
                                <td>
                                    <a href="#" @click="viewEnquiry(enquiry.id)">
                                        <i class="fa fa-eye blue"></i>
                                    </a>
                                    <a href="#" @click="deleteEnquiry(enquiry.id)">
                                        <i class="fa fa-trash red"></i>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="showModal" tabindex="-1" role="dialog" aria-labelledby="showModalLabel"
             aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="showModalLabel">Enquiry Detail</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <template v-for="detail in details">
                            <h4 class="mb-5">Enquiry Received:  {{detail.created_at}}</h4>
                            <h4 class="mb-2">Property Information</h4>
                            <p><strong>Property Id</strong>: {{detail.property_id}}</p>
                            <p><strong>Property Title</strong>: {{detail.title}}</p>
                            <h4 class="mb-2 mt-4">Property Owner Information</h4>
                            <p><strong>Owner Name</strong>: {{detail.userName}}</p>
                            <p><strong>Owner Email</strong>: {{detail.userEmail}}</p>
                            <p><strong>Owner Phone</strong>: {{detail.userPhone}}</p>
                            <h4 class="mb-2 mt-4">Enquiry Sent By:</h4>
                            <p><strong>Name</strong>: {{detail.name}}</p>
                            <p><strong>Email</strong>: {{detail.email}}</p>
                            <p><strong>Phone</strong>: {{detail.mobile_number}}</p>
                            <p><strong>Message</strong>: </p>
                            <p>{{detail.message}}</p>
                        </template>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close <i
                                class="fas fa-times-circle"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</template>
<script>
    export default {
        data() {
            return {
                enquiries: {},
                details: {}
            }
        },
        created() {
            this.loadEnquiry();
            this.$on('deleteEnquiry', () => {
                this.loadEnquiry();
            });
        },
        methods: {
            deleteEnquiry(id) {
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
                        axios.delete('/api/enquiry/' + id)
                            .then(() => {
                                swal.fire(
                                    'Deleted!',
                                    'Your file has been deleted.',
                                    'success'
                                );
                                this.$emit('deleteEnquiry');
                            })
                            .catch(() => {
                                swal("Failed!", "There was something wrong.", "warning");
                            });
                    }
                })
            },
            loadEnquiry() {
                axios.get('/api/enquiry')
                    .then((data) => {
                        this.enquiries = data.data;
                    })
                    .catch(() => {

                    });
            },

            viewEnquiry(id) {
                axios.get('/api/enquiry/' + id)
                    .then((data) => {
                        this.details = data.data;
                    })
                $('#showModal').modal('show');
            },
        }
    }
</script>
<style scoped>
    p{
        margin:0!important;
    }
</style>
