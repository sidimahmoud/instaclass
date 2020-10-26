<template>
    <div>
        <div>
            <div class="row justify-content-around align-items-center shadow-sm course-det p-1">
                <div class="col-md-2" :style="{
                  backgroundImage: 'url(' + course.sub_category.category.image + ')',
                  backgroundSize: 'cover',
                  backgroundRepeat: 'no-repeat',
                  height: '115px',
                  padding: '0',
                  border: '1px solid black',
                  borderRadius: '20px'
                }">
                    <!--                    <img :src="course.sub_category.category.image" :alt="course.sub_category.category.image"-->
                    <!--                         class="img-fluid">-->
                </div>
                <div class="col-md-8">
                    <strong>Number of Sessions - </strong> {{course.sections.length}} <br>
                    <strong>Duration per session - </strong> {{course.estimated_duration}} <br>
                    <strong>Language - </strong> {{course.language}} <br>
                    <strong>Price per session - </strong> ${{course.price}} <br>
                    <strong>Description - </strong> {{course.description}} <br>
                </div>
                <div class="col-md-2">
                    <router-link
                        :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"
                        tag="button" class="btn btn-primary btn-block my-3">
                        S'inscrire à ce cours
                    </router-link>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <div class="fb-share-button" :data-href="'https://mondemenagement.ca/courses/'+course.id"
                                 data-layout="button" data-size="large">
                                <a target="_blank"
                                   :href="'https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fmondemenagement.ca%2Fcourses%2F'+course.id+'&amp;src=sdkpreparse'"
                                   class="fb-xfbml-parse-ignore">
                                    <img src="../../assets/images/fbShare.png" width="70px" alt="">
                                    <img src="../../assets/images/share.png" width="40px" alt="">
                                </a>
                            </div>

                        </div>
                        <div class="col-6">
                            <router-link :to="{ name: 'Detail', params: { slug: course.id}}" tag="a">
                                <button class="btn btn-primary mb-1">Learn more</button>
                            </router-link>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--        <div class="col-md-4 col-sm-12 mb-2 shadow-lg">-->
        <!--            <div class="card">-->
        <!--                        <router-link :to="{ name: 'Detail', params: { slug: course.id}}" tag="a">-->
        <!--                            <img class="card-img-top" :src="course.image">-->
        <!--                        </router-link>-->
        <!--                <div class="card-body">-->
        <!--                    &lt;!&ndash;                        <h5 class="card-title">Card title</h5>&ndash;&gt;-->
        <!--                    <p class="card-text">-->
        <!--                        <strong>Category - </strong> {{course.sub_category.category.name_en}} <br>-->
        <!--                        <strong>Sub-category - </strong> {{course.sub_category.name_en}} <br>-->
        <!--                        <strong>Duration - </strong> {{course.estimated_duration}} <br>-->
        <!--                        <strong>Language - </strong> {{course.language}} <br>-->
        <!--                        <strong>Sessions - </strong> {{course.sections.length}} <br>-->
        <!--                        <strong>Price - </strong> ${{course.price}} <br>-->

        <!--                    </p>-->

        <!--                            <router-link-->
        <!--                                :to="{ name: 'Checkout', params: {id: course.id, name: course.name, price: course.price}}"-->
        <!--                                tag="button" class="btn btn-primary btn-block my-3">-->
        <!--                                S'inscrire à ce cours-->
        <!--                            </router-link>-->
        <!--                </div>-->
        <!--            </div>-->

        <!--        </div>-->
    </div>

</template>
<script>

    export default {
        name: "Course",
        props: ["course"],

    };

</script>
<style lang="scss" scoped>
    a {
        color: rgba(0, 0, 0, 0.7);
    }

    a:hover {
        text-decoration: none;
        color: #000000;
    }

    .course-det {
        border-radius: 15px;
        margin: 10px;
        background: linear-gradient(90deg,
            rgb(0, 0, 0, 0.5),
            rgb(255, 255, 255, 1));
        font-weight: 800 !important;
        border-right: 2px solid #2b63f3;
    }
</style>
