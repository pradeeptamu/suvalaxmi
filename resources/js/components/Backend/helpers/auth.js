//get logged in
export function login(credentials) {
    return new Promise((res, rej) => {
        axios
            .post("/api/admin/login", credentials)
            .then((response) => {
                res(response.data);
            })
            .catch((err) => {
                rej("Wrong email or password");
            });
    });
}
//get admin object
export function getAdmin() {
    const admin = localStorage.getItem("admin");

    if (!admin) {
        return null;
    }

    return JSON.parse(admin);
}
