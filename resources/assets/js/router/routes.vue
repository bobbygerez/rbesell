<script type="text/javascript">

import AccessRights from './dashboard/AccessRights.vue'
import Positions from './dashboard/Positions.vue'
import users from './dashboard/users.vue'
import Merchant from './dashboard/Merchant.vue'
import Branches from './dashboard/branches/branch.vue'
import Products from './dashboard/product/Products.vue'
import UserProfile from './dashboard/UserProfile.vue'

	export const routes = [
	  { path: '/access-rights', component: AccessRights},
	  { path: '/positions', component: Positions },
	  { path: '/users', component: users },
	  { path: '/products', component: Products },
	  { path: '/user-profile', component: UserProfile},
	  { path: '/merchant', component: Merchant},
	  { path: '/branches', component: Branches}

	]
</script>