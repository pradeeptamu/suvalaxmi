<template>
    <div class="container-fluid">
        <div class="row mt-4">
            <!-- Property header section with image-->
            <section class="property_details_header mt-5">
                <img src="/img/global/aboutbanner.jpg" class="img-header">
                <div class="title">
                    About Us
                </div>
            </section>
            <!-- End of property header section with image-->
        </div>
        <div class="whoarewe mt-5">
            <h2 align="center"> Who are we?</h2>
            <p align="center" class="who mt-3">
                Suvalaxmi Realestate provides services to those who want to buy, sell and rent their properties. It is
                an online marketplace for those who want to deal with properties in Nepal. It is a platform where the
                buyer and the seller can deal with the properties directly with each other. It is simply a <b>bridge
                between the buyers and the sellers.</b>
                Suvalaxmi realestate is a platform to disseminate real estate industry information.</p>
        </div>
        <div class="whoarewe my-5">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <img src="/img/global/about.jpg" width="100%">
                </div>
                <div class="col-lg-6 col-md-12 text-center about-us">
                    <h3> SUVALAXMI REALESTATE</h3>
                    <p align="justify" class="about mt-3">
                        It provides comprehensive detail on real estate properties which are for sale or rent. Suvalaxmi
                        realestate brings together property information - location, price, pictures, and property
                        features through website.
                    </p>
                    <p align="justify" class="about">
                        It aims to overcome the limitation of traditional method of real estate advertisement, like
                        newspaper, brochures, leaflets or other forms of mass media, which are confined to limited time,
                        space and audience. With Real Estate effectively advertisement of property for a longer
                        time-period at minimum cost can be done which reach wider range of audience internationally.
                    </p>

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        name: "About",
        created() {
            window.scrollTo(0, 0);
        },
    }
</script>

<style scoped lang="scss">
    .property_details_header {
        width: 100%;
        background: black;
        height: 50vh;

        @media only screen and (max-width: 1100px) {
            height: 35vh;
        }
        img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            object-position: top;
            opacity: 0.6;
        }
        .title {
            position: relative;
            top: -35vh;
            font-size: 8vh;
            font-weight: bold;
            color: whitesmoke;
            display: flex;
            justify-content: center;
            width: 100%;
            text-shadow: 4px 3px 0 #000;
            @media only screen and (max-width: 1100px) {
                top: -15vh;
                font-size: 4vh;
            }
        }
    }

    .whoarewe p {
        line-height: 1.8em;
    }

    .whoarewe {
        margin: 1rem;
        @media(min-width: 768px) {
            margin: 3rem;
        }
        p {
            text-align: justify;
        }
    }
</style>