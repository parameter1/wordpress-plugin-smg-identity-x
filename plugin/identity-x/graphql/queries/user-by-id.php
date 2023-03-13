<?php

$idxQueryUserById = 'query WPICLE_UserById($id: String!) {
	appUserById(input: { id: $id }) {
		id
		email

		givenName
		familyName
		city
		countryCode
		region { name }
		organization
		organizationTitle
		phoneNumber
		postalCode

		customSelectFieldAnswers(input: { onlyActive: true }) {
			id
			field { id name multiple }
			answers { option { id label } }
		}

	}
}';
