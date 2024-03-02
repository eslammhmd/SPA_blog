import { createRouter , createWebHistory } from "vue-router";
import Home from '../pages/Home.vue';
import Blog from '../pages/Blog.vue';
import Navbar from '../pages/Inc/Navbar.vue';
import Contact from '../pages/Contact.vue';
import SingleBlog from '../pages/SingleBlog.vue';
import Login from '../pages/Login.vue';
import Dashboard from '../pages/Dashboard.vue';
import CreateCategory from '../pages/Categories/CreateCategory.vue';
import CategoryList from '../pages/Categories/CategoryList.vue';
import EditCategory from '../pages/Categories/EditCategory.vue';
import CreatePost from '../pages/Posts/CreatePost.vue';

const routes = [
    {
        path : "/",
        name : "Home",
        component : Home,
    },
    {
        path : "/navbar",
        name : "Navbar",
        component : Navbar,
    },
    {
        path : "/blog",
        name : "Blog",
        component : Blog,
    },
    {
        path : "/contact",
        name : "Contact",
        component : Contact,
    },

    {
        path : "/blog/:slug",
        name : "SingleBlog",
        component : SingleBlog,
        props : true,
    },
    {
        path : "/categories/create",
        name : "CreateCategory",
        component : CreateCategory,
        meta:{requiresAuth : true},

    },
    {
        path : "/categories",
        name : "CategoryList",
        component : CategoryList,
        meta:{requiresAuth : true},

    },
    {
        path : "/dashboard",
        name : "Dashboard",
        component : Dashboard,
        // disable if someone loggedIn
        meta:{requiresAuth : true},
    },
    {
        path : "/categories/:id/edit",
        name : "EditCategory",
        component : EditCategory,
        // disable if someone loggedIn
        meta:{requiresAuth : true},
        props : true,
    },
    {
        path : "/login",
        name : "Login",
        component : Login,
        meta:{requiresGuest : true},
    },
    {
        path : "/create/post",
        name : "CreatePost",
        component : CreatePost,
        meta:{requiresAuth : true},
    },
];

const router = createRouter({
    history:createWebHistory(),
    // routes:router,
    routes,
});


router.beforeEach((to,from)=>{
    const authenticated = localStorage.getItem('authenticated');
    if(to.meta.requiresGuest && authenticated){
        return {
            name : 'Dashboard'
        };
        }else if (to.meta.requiresAuth && !authenticated) {
            return{
                name:'Login',
            }
        }
    })

export default router;