<script type="text/javascript">
	
	export const state = {
		mainCategories: [],
		drawer: true,
		loginDialog: false,
		registerDialog: false,
		productables:{},
		extLinkModal: false,
		branchUrlSave: window.location.origin + '/api/branch-company-info-update',
		activeTab: 0,
		showModal: false,
		branch: {
			branch_name: '',
			merchant: {

				website: ''
			},
			address: {
				address_id: '',
				address_type: '',
				country_id: '',
				region_id:'',
				province_id: '',
				municipality_id: '',
				barangay_id: '',
				lat: '',
				long: ''
			}
		},
		page: 0,
		per_page: 10,
		mapZoom: 6,
		placeCountry: '',
		placeCity: '',
		placeAddress: '',
		title: '',
		users: {
			data: [],
			last_page: 0
		},
		user: {
				id: 0,
				personal_data:{
					lastname: '',
					firstname: ''
				},
				status: '',
				roles: {
				},
				contact_data: {

					messenger_acct: ''
				}
			},
		chunkRoles: {},
		roles: {},
		maritalStatus: {},
		checkedRoles: [],
		countries: [],
		regions: [],
		provinces: [],
		cities: [],
		branches: {
			last_page: 0
		},
		products: {
			last_page: 0
		},

		product: {
			id: 0,
			unit_id: '',
			name: '',
			discount: '',
			discount2: '',
			user: {

				personal_data: {
					firstname: '',
					lastname: ''
				}
			},
			quantities: [

				{qty: 0}
			]
				
			
		},
		units: {},
		userModal: false,
        alertMessage: '',
        status: [{name: 'Active' , value: 1}, {name: 'Inactive', value: 0}],
        heirarchy: 0,
        positions: {

        	name: '',
        	desc: '',
        	created_at: ''
        },
        position: {
        	name: '',
        	desc: '',
        	created_at: ''
        },
        roles:{},
        currentRoles: {},
        usersMatch: [

                {user: 'aaa', id: 0},
            ],
        mainFunctions: {},
        policies: {},
        userPolicies: {
        	
        },
        merchants: {
        	last_page: 0
        },
        merchant: {
        	trade: {
        		name: '',
        		for_franchise: 0
        	},
        	franchisee: {
        		trade: {
        			name: ''
        		}
        	},
        	address: {
        		lat: 0,
        		long: 0,
        		street: '',
        		country: {
        			name: ''
        		},
        		province: {
        			name: ''
        		},
        		city: {

        			name: ''
        		}
        	}
        },
        regMessage: '',
        myAccount: 'My Account',
        registeredBy: {},
        ownershipType: {},
        coordinates: { lat: '', long: '' }

	}
</script>