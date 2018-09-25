		<link href="https://cdn.jsdelivr.net/npm/suggestions-jquery@17.10.1/dist/css/suggestions.min.css" type="text/css" rel="stylesheet" />
		<style>
			.suggestions-wrapper {
				font-size: 2em;
				color: black;
			}
		</style>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
		<!--[if lt IE 10]>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxtransport-xdomainrequest/1.0.1/jquery.xdomainrequest.min.js"></script>
		<![endif]-->
		<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/suggestions-jquery@17.10.1/dist/js/jquery.suggestions.min.js"></script>
		<script type="text/javascript">
		    $("#address").suggestions({
		        token: "4f4abe3d5cec246150b5debedd1d92ed79d1be9f",
		        type: "ADDRESS",
		        count: 5,
		        /* Вызывается, когда пользователь выбирает одну из подсказок */
		        onSelect: function(suggestion) {
		            //console.log(suggestion);
		            var address = suggestion.data;
		            alert(address.postal_code);
		        }	        
		    });
		    
		    // Инициализирует подсказки по ФИО на указанном элементе
			function init($surname, $name, $patronymic) {
			  var self = {};
			  self.$surname = $surname;
			  self.$name = $name;
			  self.$patronymic = $patronymic;
			  var fioParts = ["SURNAME", "NAME", "PATRONYMIC"];
			  $.each([$surname, $name, $patronymic], function(index, $el) {
			    var sgt = $el.suggestions({
			      token: "5ef98f5781a106962077fb18109095f9f11ebac1",
			      type: "NAME",
			      triggerSelectOnSpace: false,
			      hint: "",
			      noCache: true,
			      params: {
			        // каждому полю --- соответствующая подсказка
			        parts: [fioParts[index]]
			      },
			      onSearchStart: function(params) {
			        // если пол известен на основании других полей,
			        // используем его
			        var $el = $(this);
			        params.gender = isGenderKnown.call(self, $el) ? self.gender : "UNKNOWN";
			      },
			      onSelect: function(suggestion) {
			        // определяем пол по выбранной подсказке
			        self.gender = suggestion.data.gender;
			      }
			    });
			  });
			};

			// Проверяет, известен ли пол на данный момент
			function isGenderKnown($el) {
			  var self = this;
			  var surname = self.$surname.val(),
			      name = self.$name.val(),
			      patronymic = self.$patronymic.val();
			  if (($el.attr('id') == self.$surname.attr('id') && !name && !patronymic) ||
			      ($el.attr('id') == self.$name.attr('id') && !surname && !patronymic) ||
			      ($el.attr('id') == self.$patronymic.attr('id') && !surname && !name)) {
			    return false;
			  } else {
			    return true;
			  }
			}

			init($("#family_name"), $("#name"), $("#soname"));
		</script>		