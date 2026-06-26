import { createRouter, createWebHistory } from "vue-router";

import Login from "../views/Login.vue";
import Register from "../views/Register.vue";
import EmployeeList from "../views/EmployeeList.vue";

const routes = [
  {
    path: "/",
    redirect: "/login",
  },
  {
    path: "/login",
    component: Login,
  },
  {
    path: "/register",
    component: Register,
  },
  {
    path: "/employees",
    component: EmployeeList,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;