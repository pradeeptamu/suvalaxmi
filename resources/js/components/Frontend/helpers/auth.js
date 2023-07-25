export function login(credentials) {
    console.log("we here");
    return new Promise((res, rej) => {
        axios
            .post("/api/login", credentials)
            .then((response) => {
                res(response.data);
            })
            .catch((err) => {
                rej("Wrong email or password");
            });
    });
}

export function getUser() {
    const user = localStorage.getItem("user");
    if (!user) {
        return null;
    }

    return JSON.parse(user);
}
