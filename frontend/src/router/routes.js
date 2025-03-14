

export default [
  

    {
        path: "/",
        name: "TCF",
        meta: {
            title: "Tcf Test",
        },
        component: () => import("../views/test.vue"),
    },
    {
        path: "/addQuestion",
        name: "Question",
        meta: {
            title: "addQuestion",
        },
        component: () => import("../views/addQuestion.vue"),
    },{
        path: "/AllQuestions",
        name: "AllQuestions",
        meta: {
            title: "AllQuestions",
        },
        component: () => import("../views/questions.vue"),
    },
    {
        path: '/editQuestion/:id',
        name: 'editQuestion',
        component: () => import("../views/editQuestion.vue"),
        props: true
    },

    /*
    {
        path: '/login',
        name: "Login",
        meta: {
            title: "Login",
        },
        component: () => import("../views/login.vue"),
    },*/

];
