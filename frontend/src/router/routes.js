

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
