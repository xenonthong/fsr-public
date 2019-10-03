import Home from './pages/Home';
import Register from './pages/Register';
import Login from './pages/Login';
import Account from './pages/Account';
import Verification from './pages/Verification';
import Error404 from './pages/404';
import Beneficiaries from './pages/Beneficiaries';
import BeneficiaryEdit from './pages/BeneficiaryEdit';
import BeneficiaryCreate from './pages/BeneficiaryCreate';
import TransactionCreate from './pages/TransactionCreate';
import TransactionDetail from './pages/TransactionDetail';
import TermsAndConditions from './pages/TermsAndConditions';
import Policy from './pages/Policy';
import Faq from './pages/Faq';
import store from './store';
import Transactions from "./pages/Transactions";
import ForgetPassword from "./pages/ForgetPassword";
import ResetPassword from "./pages/ResetPassword";

let routes = [
    {
        path : '/',
        name : 'home',
        component : Home,
    },
    {
        path : '/register',
        name : 'register',
        component : Register,
        beforeEnter : guest
    },
    {
        path : '/login',
        name : 'login',
        component : Login,
        beforeEnter : guest
    },
    {
        path : '/account',
        name : 'account',
        component : Account,
        beforeEnter : auth
    },
    {
        path : '/verification',
        name : 'verification',
        component : Verification,
        beforeEnter : auth
    },
    {
        path : '/me/beneficiaries',
        name : 'beneficiaries',
        component : Beneficiaries,
        beforeEnter : verified
    },
    {
        name : 'beneficiaryEdit',
        path : '/me/beneficiaries/:id/edit',
        component : BeneficiaryEdit,
        beforeEnter : verified
    },
    {
        name : 'beneficiaryCreate',
        path : '/me/beneficiaries/create',
        component : BeneficiaryCreate,
        beforeEnter : verified,
    },
    {
        path : '/me/transactions',
        name : 'transactions',
        component : Transactions,
        beforeEnter : verified
    },
    {
        name : 'transactionCreate',
        path : '/me/beneficiaries/:id/transfer',
        component : TransactionCreate,
        beforeEnter : verified,
    },
    {
        name : 'transactionDetail',
        path : '/me/transactions/:id',
        component : TransactionDetail,
        beforeEnter : verified,
    },
    {
        path : '/terms-and-conditions',
        name : 'tnc',
        component : TermsAndConditions
    },
    {
        path : '/policy',
        name : 'policy',
        component : Policy
    },
    {
        path : '/frequently-asked-questions',
        name : 'faq',
        component : Faq
    },
    {
        name : 'forgetPassword',
        path : '/password/reset',
        component : ForgetPassword,
        beforeEnter : guest
    },
    {
        name : 'resetPassword',
        path : '/password/reset/:token',
        component : ResetPassword,
        beforeEnter : guest
    },
    {
        path : '*',
        component : Error404,
    }
];

/**
 * User has to be authenticated to access the routes.
 *
 * @param to
 * @param from
 * @param next
 */
function auth(to, from, next) {
    if (!store.getters.isAuthenticated) {
        next('/login');

        return;
    }

    next();
}

/**
 * User has to be a guest to access the routes.
 *
 * @param to
 * @param from
 * @param next
 */
function guest(to, from, next) {
    if (store.getters.isAuthenticated) {
        next('/');

        return;
    }

    next();
}

/**
 * User has to be authenticated and verified to access the routes.
 *
 * @param to
 * @param from
 * @param next
 */
function verified(to, from, next) {
    if (!store.getters.isVerified) {
        next('/verification');

        return;
    }

    next();
}

export default routes;