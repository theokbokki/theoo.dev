import axios from "axios";

import.meta.glob(["../icons/**", "../images/**", "../fonts/**"]);

window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
