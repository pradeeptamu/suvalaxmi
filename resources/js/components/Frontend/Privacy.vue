<template>
    <div class="container-fluid">
        <h3><strong>Privacy Policy (SuvaLaxmi RealEstate)</strong></h3>
        <p>ShuvaLaxmi ensures that your personal data is protected and safeguarded as much as possible. We are extremely
            concerned to protect your privacy and confidentiality. We understand that all users of our site are quite
            concerned to know that their data will not be used for any purpose unintended by them, and will not
            accidentally fall into the hands of third party. We will only provide your details to our other customers
            with your authorization.</p>
        <h5><strong>Collection of Personal Information</strong></h5>
        <p>We may collect the following information:</p>
        <ul>
            <li>Your name</li>
            <li>Email address</li>
            <li>Phone Number</li>
            <li>Image</li>
        </ul>
        <h5><strong>Use of Your Information</strong></h5>
        <ul>
            <li>To provide you with the services which you request.</li>
            <li>For verifying your identity for security purposes.</li>
            <li>For marketing our services and products.</li>
            <li>For communication with buyers and sellers.</li>
            <li>For updating you with latest updates and alerts.</li>
        </ul>
        <h4><strong>Security</strong></h4>
        <p>With all the personal information you share with us, we are vigilant and use it only for the purposes set out
            in this policy.
            We ensure that all third party platforms and services that we share your details with guarantee the security
            of your information.</p>
        <h4><strong>Contact Us</strong></h4>
        <p>If you have any enquires, doubts or the need for clarification regarding the privacy policy of ShuvaLaxmi,
            then you may contact us on the information given below, via email or phone.</p>
    </div>
</template>

<script>
    export default {
        name: "Privacy",
        created() {
            window.scrollTo(0, 0);
        },
    }
</script>

<style scoped lang="scss">
    .container-fluid {
        margin-top: 9rem;
        margin-bottom: 6rem;
        max-width: 85%;
        @media (max-width: 768px) {
            margin-top: 6rem;
        }
        p {
            text-align: justify;
            font-size: 16px;
            font-family:  "Segoe UI", Roboto;
        }
        li{
            font-size: 16px;
            font-family:  "Segoe UI", Roboto;
        }
    }

    h3{
        margin-bottom: 2rem;
        text-align: center;
        color:#232323;
    }

</style>