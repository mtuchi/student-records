var REGEX_EMAIL = '([a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@' +
                  '(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)';
var formatName = function(item) {
	return $.trim((item.first_name || '') + ' ' + (item.last_name || ''));
};
$('#select-to').selectize({
	persist: false,
	maxItems: null,
	valueField: 'email',
	labelField: 'name',
	searchField: ['first_name', 'last_name', 'email'],
	// sortField: [
	// 	{field: 'first_name', direction: 'asc'},
	// 	{field: 'last_name', direction: 'asc'}
	// ],
	// options: [
	// 	{email: 'nikola@tesla.com', first_name: 'Nikola', last_name: 'Tesla'},
	// 	{email: 'brian@thirdroute.com', first_name: 'Brian', last_name: 'Reavis'},
	// 	{email: 'someone@gmail.com'}
	// ],
	render: {
		item: function(item, escape) {
			var name = formatName(item);
			return '<div>' +
				(name ? '<span class="name">' + escape(name) + '</span>' : '') +
				(item.email ? '<span class="email">' + escape(item.email) + '</span>' : '') +
			'</div>';
		},
		option: function(item, escape) {
			var name = formatName(item);
			var label = name || item.email;
			var caption = name ? item.email : null;
			return '<div>' +
				'<span class="label">' + escape(label) + '</span>' +
				(caption ? '<span class="caption">' + escape(caption) + '</span>' : '') +
			'</div>';
		}
	},
	createFilter: function(input) {
		var regexpA = new RegExp('^' + REGEX_EMAIL + '$', 'i');
		var regexpB = new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i');
		return regexpA.test(input) || regexpB.test(input);
	},
	create: function(input) {
		if ((new RegExp('^' + REGEX_EMAIL + '$', 'i')).test(input)) {
			return {email: input};
		}
		var match = input.match(new RegExp('^([^<]*)\<' + REGEX_EMAIL + '\>$', 'i'));
		if (match) {
			var name       = $.trim(match[1]);
			var pos_space  = name.indexOf(' ');
			var first_name = name.substring(0, pos_space);
			var last_name  = name.substring(pos_space + 1);
			return {
				email: match[2],
				first_name: first_name,
				last_name: last_name
			};
		}
		alert('Invalid email address.');
		return false;
	}
});
