<template>
    <div>
        <div class="jumbotron">
            <!--            <div class="row justify-content-around align-items-center">-->
            <!--                <div class="container d-flex align-items-center justify-content-center">-->
            <div class="text-center" style="color: #F1F0F8 !important;">

            </div>
            <!--                </div>-->
            <!--            </div>-->
        </div>

        <div class="container d-flex flex-column text-center align-items-center justify-content-center">
            <p class="h3" style="color: #1a2447  !important">How it works</p>
            <p>The platform allows you to teach and learn live or pre-recorded courses. <br>Sessions can be free or
                paying.</p>
        </div>

        <!--        cards-->
        <div class="container">
            <div class="row">
                <div class="row  ">
                    <div class="col-sm-12 card shadow-sm my-2">
                        <div class="card-body  ">
                            <h5 class="card-title about-headings">Live courses</h5>
                            <p class="card-text">The educator schedule the date,hour and number of sessions.
                                <br>
                                learners will subscribe to class and follow live from their computer,
                                laptop,phone or
                                tablet
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 card shadow-sm my-2">
                        <div class="card-body">
                            <h5 class="card-title about-headings">Pre-recorded course</h5>
                            <p class="card-text">
                                when agreed with the learners,the educators can create post a pre-recorded
                                course,
                                which can be viewed on platform or uploaded
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 card shadow-sm my-2">
                        <div class="card-body">
                            <h5 class="card-title about-headings">Quality live stream</h5>
                            <p class="card-text">
                                To ensure a good learners experience,
                                we suggest to the educators to have high quality camera
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 card shadow-sm my-2">
                        <div class="card-body">
                            <h5 class="card-title about-headings">Free Courses</h5>
                            <p class="card-text">
                                the educator can choose to give a free course.He/she can put it public, so
                                anyone can learn
                                from
                                it or can invite limited people
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 card shadow-sm my-2">
                        <div class="card-body">
                            <h5 class="card-title about-headings">Paying courses</h5>
                            <p class="card-text">
                                when a course is payed,it is private and only those enrolled in it can take it.
                                A 10% commission to maintain and use the platform is collected by instantclasse.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 card shadow-sm my-2">
                        <div class="card-body">
                            <h5 class="card-title about-headings">Withdrawal of payment</h5>
                            <p class="card-text">
                                Payments are ,ade at the en of each session.At least half the learners must
                                approve that the session they attended ,et the expectations for the educator to
                                be paid.
                                when there is only one learner, an instantclasse administrator wil approve the
                                session.
                            </p>
                        </div>
                    </div>
                    <div class="col-sm-12 card shadow-sm my-2">
                        <div class="card-body">
                            <h5 class="card-title about-headings">Prohibited Course</h5>
                            <p class="card-text">
                                courses that encourage are related from near or far to hatred, weapons,
                                drugs are strictly prohibited on this platform.An administrator can join private
                                classes,remove and block courses
                                deemed inappropriate
                            </p>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "About"
    }
</script>

<style scoped>
    .about-headings {
        color: #1a2447 !important;
        font-weight: bold;
    }

    .jumbotron {
        background-image: url('../assets/images/home/bg.png');
        border-radius: 0;
    }
</style>
