document.querySelector("#show_password").onclick = function(){
			let pass = document.querySelector("#password_id");
			if(pass.type === "password") {
				pass.type = "text";
				document.querySelector(".bi-eye").classList.remove("hidden");
				document.querySelector(".bi-eye-slash").classList.add("hidden");
			} else {
				pass.type = "password";
				document.querySelector(".bi-eye").classList.add("hidden");
				document.querySelector(".bi-eye-slash").classList.remove("hidden");
			}
		}
