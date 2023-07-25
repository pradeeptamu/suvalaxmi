<template>
    <div>
        <div class="row contact-details container-fluid">
            <div class="col-6 col-md-4 center py-3" align="center">
                <i class="fa fa-map-marker fa-lg p-2"></i>
                <h6 class="aboutus-footer-title font-weight-bold  pb-1">Address</h6>
                <h6>Chaksibari, Thamel</h6>
                <h6>Kathmandu</h6>
            </div>
            <div class="col-6 col-md-4 details-sec py-3" align="center">
                <i class="fa fa-phone p-2 fa-lg"></i>
                <h6 class="aboutus-footer-title font-weight-bold  pb-1">Contact</h6>
                <h6>+977 9851214726</h6>
                <h6>+01 4701833</h6>
            </div>

            <div class="col-6 col-md-4 details-sec py-3" align="center">
                <i class="fa fa-envelope fa-lg p-2"></i>
                <h6 class="aboutus-footer-title font-weight-bold  pb-1">Email</h6>
                <h6>suvalaxmirealestate@gmail.com</h6>
            </div>
        </div>
        <div class="faq-section container">
            <h3>Frequently Asked Questions</h3>

            <!--faqs-->
            <div class="faq" v-for="faq in faqs">
                <div class="question" @click="toggle(faq)">
                    <h5>{{ faq.question }} </h5>
                    <span v-text="faq.isOpen ? '-' : '+'"></span>
                </div>
                <hr>
                <div v-show="faq.isOpen" class="answer">
                    <p>{{ faq.answer }}</p>
                </div>
            </div>
        </div>
        <div class="contact mx-5 my-5">
            <div class="row">
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="../assets/images/email.png">
                </div>
                <div class="col-md-6 text-center enquiry">
                    <h3>IF ANY ENQUIRY?</h3>
                    <div class="form  ">
                        <form @submit.prevent="createEnquiry()" class="">
                            <div class="form-group mb-2">
                                <input type="text" v-model="form.name" class="form-control" name="name"
                                    placeholder="Your Name" :class="{ 'is-invalid': form.errors.has('name') }">
                                <has-error :form="form" field="name"></has-error>
                            </div>
                            <div class="form-group mb-2">
                                <input type="email" v-model="form.email" class="form-control" name="email"
                                    placeholder="Email Address" :class="{ 'is-invalid': form.errors.has('email') }">
                                <has-error :form="form" field="email"></has-error>
                            </div>
                            <div class="form-group mb-2">
                                <input type="number" v-model="form.mobile_number" class="form-control" name="mobile"
                                    placeholder="Mobile Number" :class="{ 'is-invalid': form.errors.has('mobile_number') }">
                                <has-error :form="form" field="mobile_number"></has-error>
                            </div>
                            <div class="form-group mb-5">
                                <textarea type="text" v-model="form.message" class="form-control" name="message"
                                    placeholder="Message" :class="{ 'is-invalid': form.errors.has('message') }"></textarea>
                                <has-error :form="form" field="message"></has-error>
                            </div>

                            <input type="hidden" v-model="form.owner_id" name="owner_id">
                            <input type="hidden" v-model="form.property_id" name="property_id">

                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-outline-primary m-auto w-50">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
export default {
    data() {
        return {
            faqs: [
                {
                    isOpen: false,
                    question: 'What is this Website About?',
                    answer: 'This website is a way to make selling and purchasing real estate in Nepal simple and more accessible. We let sellers list their property and provide them a platform to find buyers.'
                },
                {
                    isOpen: false,
                    question: 'When did this establish ?',
                    answer: 'It is registered on 2012 in Kathmandu, Nepal.'
                },
                {
                    isOpen: false,
                    question: 'How can this help sell my property?',
                    answer: ' Anyone who has property can submit their details through our website and it will be added in our database and can be viewed by potential customers.'
                },
                {
                    isOpen: false,
                    question: 'How can I add My Property in the Website?',
                    answer: ' All you need to do is open an account on our website. Then, you can start posting your property,and thousands of potential customers will view your house, land or apartment.'
                },
                {
                    isOpen: false,
                    question: 'What is this WebsitIf I am an agent can I also add property which is on my contact to ShuvaLaxmi?',
                    answer: 'Yes you can sign up and add your property .'
                }
            ],
            form: new Form({
                name: '',
                email: '',
                mobile_number: '',
                message: '',
                owner_id: '',
                property_id: '',
            }),
        }
    },
    created() {
        window.scrollTo(0, 0);
    },
    methods: {
        toggle(faq) {
            faq.isOpen = !faq.isOpen
        },
        createEnquiry() {
            this.form.post('/api/enquiry')

                .then(() => {
                    this.form.reset();
                    Toast.fire({
                        type: 'success',
                        title: 'Enquiry has been sent !!!'
                    });
                    this.$Progress.finish();
                })

                .catch(() => {
                    console.log('error');
                });
        },
    }
}
</script>

<style scoped lang="scss">
.faq-section {
    h3 {
        color: #232323;
        padding: 3rem 0;
    }
}

.question {
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #232323;
    cursor: pointer;

    h5 {
        margin: 0;
    }

    span {
        font-size: 30px;
    }
}

.answer {
    font-size: 15px;
    margin-bottom: 2rem;
    text-align: justify;
    color: #4d4d4d;
}

.contact-btn {
    background-color: #6cb2eb;
    color: white;
}

.contact-details {
    background-color: ghostwhite;
    margin-top: 5rem;
    margin-right: auto;
    margin-left: auto;

    @media(min-width: 768px) {
        padding: 2rem 0;
    }
}

@media(max-width: 768px) {
    .enquiry h3 {
        font-size: 130%;
        margin-top: 2em;
    }
}

.container {
    max-width: 90% !important;
}

i {
    color: #38A1DA;
}

hr {
    margin-top: 1rem;
    margin-bottom: 1rem;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, 0.1);
}

img {
    width: 40%;
}
</style>