"use strict";

class validator extends request {

	validate = {
		isValid: true,
		messages: []
	};

  empty(data) {
    return data.length == 0;
  }

  minLength(data, min) {
    return data.length >= min;
  }

  maxLength(data, max) {
    return data.length <= max;
	}
	
	equalLength(data, compare) {
    return data.length == compare;
  }

  compare(data, compare) {
    return data == compare;
  }
}
