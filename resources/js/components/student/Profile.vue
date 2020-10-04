<template>
    <div>
        <div class="text-center text-primary" v-if="profileLoading">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-else>
            <div class="jumbotron text-right">
                <span class="font-weight-bold text-white mr-2">Bonjour {{userProfile.first_name}}</span>
                <button class="btn btn-danger" @click="logout">
                    Logout
                </button>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="text-center ">
                            <div class="card bg-primary">
                                <div class="card-body text-center text-white">
                                    <img :src="userProfile.image" alt="Avatar" width="60px" class="rounded-circle">
                                    <h3 class="card-title font-weight-bolder">{{userProfile.first_name}}
                                        {{userProfile.last_name}}</h3>
                                    <p class="card-text">{{userProfile.headline}}</p>
                                    <router-link :to="{name: 'EditStudentProfile'}" tag="a" class="btn btn-danger">
                                        Edit Profile
                                    </router-link>
                                </div>
                            </div>
                        </div>
                    </div>
<!--                    <div class="col-md-6" v-if="userEnrollments.length>0">-->
<!--                        <Count-down-->
<!--                            :year="userEnrollments[0].course.created_at.slice(0,4)"-->
<!--                            :month="userEnrollments[0].course.created_at.slice(5,7)-1"-->
<!--                            :day="userEnrollments[0].course.created_at.slice(8,10)"-->
<!--                            :hour="userEnrollments[0].course.created_at.slice(11,13)"-->
<!--                            :minute="userEnrollments[0].course.created_at.slice(14,16)"-->
<!--                            :second="userEnrollments[0].course.created_at.slice(17,19)"-->
<!--                        />-->
<!--                    </div>-->
                    <div class="col-md-6" >
                        <Count-down
                            :year="2020"
                            :month="1"
                            :day="1"
                            :hour="0"
                            :minute="0"
                            :second="0"
                        />
                    </div>
                </div>
                <div class="row my-4 ">
                    <div class="col-md-12  shadow">
                        <nav class="nav nav-pills nav-fill mt-3">
                            <a class="nav-item nav-link active" href="#courses" data-toggle="tab">My recorded
                                courses</a>
                            <a class="nav-item nav-link " href="#receipts" data-toggle="tab">My receipts</a>
                            <a class="nav-item nav-link " href="#live" data-toggle="tab">Go live</a>
                            <a class="nav-item nav-link " href="#ratings" data-toggle="tab">Ratings</a>
                        </nav>
                        <hr class="bg-dark">
                        <div class="tab-content my-1">
                            <!-- Enrollments-->
                            <div class="tab-pane fade show active" id="courses">
                                <ul class="list-unstyled">
                                    <li class=" mt-4" v-if="userEnrollments.length===0">
                                        <p class="text-center h3 mt-3">
                                            You have no recorded courses for the moment
                                        </p>
                                    </li>
                                    <li class=" mt-4" v-else>
                                        <div v-for="e in userEnrollments" :key="e.id">
<!--                                            <div v-if="e.course.type==1">-->
<!--                                                <router-link :to="{name: 'Player', params: { slug: e.course.slug} }">-->
<!--                                                    <h5 class="mt-0 mb-1">{{e.course.name}},-->
<!--                                                        {{e.course.created_at.slice(0,10)}},-->
<!--                                                        {{e.course.created_at.slice(11,16)}},-->
<!--                                                        {{e.course.user.first_name}}-->
<!--                                                        {{e.course.user.last_name}}</h5>-->
<!--                                                </router-link>-->
<!--                                            </div>-->
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-pane fade show " id="receipts">
                                <!--                                <h3 class="text-center">Your receipts will appear here. </h3>-->
                                <div class="accordion" id="accordionExample">
                                    <div class="card" v-for="n in 3">
                                        <div class="card-header" id="headingOne">
                                            <h2 class="mb-0">
                                                <p class="btn btn-link font-weight-bolder rounded" type="button"
                                                   data-toggle="collapse"
                                                   data-target="#collapseOne"
                                                   aria-expanded="true" aria-controls="collapseOne">
                                                    Order N°#1, 2020-09-02, 6:10, Teacher Instant
                                                </p>
                                            </h2>
                                        </div>
                                        <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                             data-parent="#accordionExample">
                                            <div class="card-body">
                                                <receipt/>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="tab-pane fade show " id="live">
                                lives {{ lives.length}}
                                recs {{ recorded.length}}
                                <ul class="list-unstyled">
                                    <li class="mt-4 text-center" v-if="lives.length===0">
                                        <img src="../../assets/images/cam-icon.png" alt="" width="100">
                                        <p class="text-center h3 mt-3">
                                            You will be redirected to your live class when you will subscribe to a
                                            course
                                        </p>
                                    </li>
<!--                                    <li class="mt-4" v-for="e in userEnrollments" :key="e.id" v-else>-->
<!--                                        <div v-if="e.course.type===2">-->
<!--                                            <router-link :to="{name: 'Live', params: { slug: e.course.slug} }">-->
<!--                                                <h5 class="mt-0 mb-1">{{e.course.name}},-->
<!--                                                    {{e.course.created_at.slice(0,10)}},-->
<!--                                                    {{e.course.user.first_name}}-->
<!--                                                    {{e.course.user.last_name}}</h5>-->
<!--                                            </router-link>-->
<!--                                        </div>-->
<!--                                    </li>-->
                                </ul>
                            </div>
                            <div class="tab-pane fade show " id="ratings">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">Teacher Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Rating</th>
                                        <th scope="col">Comment</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <th scope="row">tt</th>
                                        <td>20/10/2020</td>
                                        <td>5</td>
                                        <td>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi, tenetur!</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {mapActions, mapGetters} from "vuex";
    import CountDown from "../CountDown";
    import Receipt from "./Receipt";

    export default {
        name: "StudentProfile",
        components: {CountDown, Receipt},

        methods: {
            ...mapActions(["fetchProfile", "fetchUserEnrollments"]),
            logout() {
                this.$store.dispatch('logout')
                    .then(() => {
                        this.$router.push('/')
                    })
            },
            lives() {
                return this.userEnrollments.map(item => {
                        return item.course.type === 2
                    }
                )
            },
            recorded() {
                return this.userEnrollments.map(item => {
                    return item.course.type === 1
                })
            },
        },
        computed: mapGetters(["userProfile", "userEnrollments", "profileLoading", "loadingEnrollments"]),
        created() {
            this.fetchUserEnrollments();
        },

    }
</script>

<style scoped>
    .jumbotron {
        background-image: url('../../assets/images/about/bg.png');
        border-radius: 0;
        padding: 0;
    }

    .bg {
        background: linear-gradient(180deg, rgba(75, 189, 254, 0.83), #fbf3f3);
    }
</style>
