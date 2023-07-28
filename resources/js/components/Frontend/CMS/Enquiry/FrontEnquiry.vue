<template>
    <div>
        <div class="mx-1">
            <div class="container-fluid my-4 border border-dark bg-light">
                <div class="col-12">
                    <div class="section-title text-dark my-4">
                        <h3>Enquiries</h3>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile Number</th>
                                        <th>Message</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(enquiry, index) in enquiries" :key="enquiry.id">
                                        <td>{{ index + 1 }}</td>
                                        <td class="text-capitalize">{{ enquiry.name }}</td>
                                        <td>{{ enquiry.email }}</td>
                                        <td>{{ enquiry.mobile_number }}</td>
                                        <td>{{ enquiry.message.substring(0, 25) + ".." }}</td>
                                        <td>
                                            <a href="#" @click="showEnquiry(enquiry.id)">
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
                            <p><strong>Property Id</strong>: {{ detail.id }}</p>
                            <p><strong>Property Title</strong>: {{ detail.title }}</p>
                            <p><strong>Enquiry Message</strong>: </p>
                            <p>{{ detail.message }}</p>
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
            details: {},
            owner_id: this.$store.getters.currentUser.id,
        }
    },
    created() {
        this.loadEnquiry();
    },
    methods: {
        loadEnquiry() {
            axios.get('/api/allfrontenquiries/' + this.owner_id)
                .then((data) => {
                    this.enquiries = data.data;
                })
                .catch(() => {

                });

        },
        deleteEnquiry(id) {
            this.$swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                // Send request to the server
                if (result.value) {
                    axios.delete('/api/enquiry/' + id)
                        .then(() => {
                            this.$swal.fire(
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
        showEnquiry(id) {
            axios.get('/api/frontDetailEnquiry/' + id)
                .then((data) => {
                    this.details = data.data;
                })
            $('#showModal').modal('show');
        },
    }
}
</script>
