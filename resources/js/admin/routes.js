import Vue from "vue";
import Router from "vue-router";
Vue.use(Router);

export default new Router({
    routes: [
        {
            name: "categoria",
            path: "/categoria",
            component: require("./views/categoria/All.vue").default
        },
        // {
        //     name: "business/show/account",
        //     path: "/business/:id/account",
        //     component: require("./views/business/Show.vue").default
        // },
        // {
        //     name: "home",
        //     path: "/",
        //     component: require("./views/Dashboard.vue").default
        // },
        // {
        //     name: "career",
        //     path: "/career",
        //     component: require("./views/career/All.vue").default
        // },
        // {
        //     name: "career/show",
        //     path: "/career/show/:id",
        //     component: require("./views/career/Show.vue").default
        // },
        // {
        //     name: "university",
        //     path: "/university",
        //     component: require("./views/university/All.vue").default
        // },
        // {
        //     name: "university/show",
        //     path: "/university/show/:id",
        //     component: require("./views/university/Show.vue").default
        // },
        // {
        //     name: "university/career",
        //     path: "/university/:id/career",
        //     component: require("./views/university/Career.vue").default
        // },
        // {
        //     name: "feedback",
        //     path: "/feedback",
        //     component: require("./views/feedback/All.vue").default
        // },
        // {
        //     name: "idiom",
        //     path: "/idiom",
        //     component: require("./views/idiom/All.vue").default
        // },

        // {
        //     name: "student/show",
        //     path: "/student/show/:id",
        //     component: require("./views/career/Show.vue").default
        // },
        // {
        //     name: "student/universitycareer",
        //     path: "/student/universitycareer/:id",
        //     component: require("./views/student/UniversityCareer.vue").default
        // },
        // {
        //     name: "student",
        //     path: "/student",
        //     component: require("./views/student/All.vue").default
        // },
        // {
        //     name: "student/detail",
        //     path: "/student/detail/:id",
        //     component: require("./views/student/Detail.vue").default
        // },
        // {
        //     name: "student/great",
        //     path: "/student/great/:id",
        //     component: require("./views/student/Great.vue").default
        // },
        // {
        //     name: "password/change",
        //     path: "/student/detail/:id/password/change",
        //     component: require("./views/student/ChangePassword.vue").default
        // }
    ]

});
