<script type="text/javascript">

	export const actions = {

		checkedRoles(state, roleIds){

			for (var i = 0; i < roleIds.length; i++) {
				state.commit('checkedRoles', roleIds[i])
			}
		},

		countryId(state, countryId){

			if(state.getters.branch.address == null){

				state.getters.branch.address = {

					country_id: countryId
					
				}
			}

		},

		regionId(state, regionId){

			state.getters.branch.address.region_id = regionId
		},
		provinceId(state, provinceId){

			state.getters.branch.address.province_id = provinceId
		},
		cityId(state, cityId){

			state.getters.branch.address.municipality_id = cityId
		},
		branchLat(state, lat){

			state.getters.branch.address.lat = lat
		},
		branchLong(state, long){

			state.getters.branch.address.long = long
		},
		branchAddressId(state, addressId){

			state.getters.branch.address.address_id = addressId
		},
		branchAddressType(state, addressType){
			state.getters.branch.address.address_type = addressType
		},

		deleteAddressFieldName(state, fieldName){

			delete state.getters.branch.address[fieldName]
		},

		
	}
</script>