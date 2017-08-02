<script type="text/javascript">
	export const mutations = {

		mainCategories(state, mainCategories){
			state.mainCategories = mainCategories
		},
		registerDialog(state, registerDialog){
			state.registerDialog = registerDialog
		},
		loginDialog(state, loginDialog){
			state.loginDialog = loginDialog
		},
		productables(state, productables){
			state.productables = productables
		},
		extLinkModal(state, extLinkModal){
			state.extLinkModal = extLinkModal
		},
		branchUrlSave(state, branchUrlSave){
			state.branchUrlSave = branchUrlSave
		},
		activeTab(state, activeTab){
			state.activeTab = activeTab
		},
		showModal(state, showModal){
			state.showModal = showModal
		},
		per_page(state, per_page){
			state.per_page = per_page
		},
		page(state, page){
			state.page = page
		},
		mapZoom(state, mapZoom){
			state.mapZoom = mapZoom
		},
		placeCountry(state, placeCountry){
			state.placeCountry = placeCountry
		},
		placeCity(state, placeCity){
			state.placeCity = placeCity
		},
		placeAddress(state, placeAddress){
			state.placeAddress = placeAddress
		},
		merchantTradeName(state, merchantTradeName){
			state.merchant.trade = merchantTradeName
		},
		coordinates(state, coordinates){
			state.coordinates = coordinates
		},
		
		ownershipType(state, ownershipType){
			state.ownershipType = ownershipType
		},
		tradeName(state, tradeName){

			state.merchant.trade.name = tradeName
		},
		registeredBy(state, registeredBy){

			state.registeredBy = registeredBy
		},
		myAccount(state, myAccount){

			state.myAccount = myAccount
		},
		regMessage(state, regMessage){
			state.regMessage = regMessage
		},
		merchant(state, merchant){
			state.merchant = merchant
		},
		merchants(state, merchants){
			state.merchants = merchants
		},
		clearUserPolicies(state){
			state.userPolicies = []
		},
		userPolicies(state, userPolicies){
			state.userPolicies = userPolicies
		},
		policies(state, policies){
			state.policies =  policies
		},
		mainFunctions(state, mainFunctions){

			state.mainFunctions = mainFunctions
		},
		currentRoles(state, currentRoles){
			state.currentRoles = currentRoles
		},
		user(state, payload){
			state.user = payload
		},
		users(state, payload){
			state.users = payload
		},
		roles(state, payload){
			state.roles = payload
		},
		chunkRoles(state, payload){
			state.chunkRoles = payload
		},
		maritalStatus(state, payload){
			state.maritalStatus = payload
		},
		clearRoles(state){
			state.checkedRoles = []
		},
		checkedRoles(state, roleId){
			
			state.checkedRoles.push(roleId)
		},
		cities(state, cities){

			state.cities = cities
		},
		provinces(state, provinces){
			state.provinces = provinces
		},
		regions(state, regions){
			state.regions = regions
		},
		countries(state, countries){
			state.countries = countries
		},
		title(state, title){
			state.title = title
		},
		branch(state, branch){
			state.branch = branch
		},
		branches(state, branches){
			state.branches = branches
		},
		products(state, payload){
			state.products = payload
		},
		product(state, payload){
			state.product = payload
		},
		units(state, units){

			state.units = units
		},
		alertMessage(state, alertMessage){

			state.alertMessage = alertMessage
		},
		heirarchy(state, heirarchy){
			state.heirarchy = heirarchy
		},
		positions(state, positions){

			state.positions = positions
		},
		position(state, position){

			state.position = position
		},
		usersMatch(state, usersMatch){
			state.usersMatch = usersMatch
		}
	}
</script>