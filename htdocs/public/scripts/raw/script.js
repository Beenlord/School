//= http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js
//= https://cdn.jsdelivr.net/npm/vue@2.7.8/dist/vue.js

$(document).ready(function () {
	let vue, timeout;
	$.ajax('/api/get_reason?rand')
	 .done(function (response) {
		 vue = new Vue({
			 el:      document.querySelector('main'),
			 data:    () => {
				 return {
					 screen: {
						 value: 0,
						 max:   2,
					 },
					 json: response,
					 actions: 0,
				 };
			 },
			 watch:   {
				 screen: {
					 handler(value) {
                         if (value.value == 2) this.jsonUpdate();
						 if (value.value === value.max + 1) {
							 this.screen.value = 1;
						 } else if (value.value < 0) {
							 this.screen.value = 0;
						 }
						 this.actions++;
					 },
					 deep:      true,
					 immediate: true,
				 }
			 },
			 methods: {
				 moveScreen(delta, e) {
					 if (e) e.stopPropagation();
					 this.screen.value += delta;
				 },
				 setScreen(value, e) {
					 if (e) e.stopPropagation();
					 this.screen.value = value;
				 },
				 jsonUpdate() {
					$.ajax('/api/get_reason?rand')
						.done(response => {
                            this.json = response;
                        });
				 },
			 },
		 });
	 });
});