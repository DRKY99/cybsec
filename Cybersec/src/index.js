const express = require("express");
const parser = require("body-parser");
const app = express();
const port = 3000;
var path = require("path");
app.use(parser());
let exists = true;
var request = require("request");
const { json } = require("body-parser");

app.get("/", (req, res) => {
    res.sendFile(path.join(__dirname + "/public/index.html"));
});

app.post("/login", function (req, res) {
    /* 
    Hacer preticion de inicio de sesion
        - si esta registrado,   regresar un {message:"success"}
        - si no esta registrado regresar un {message:"error"}

    Comprobar el JSON obtenido la peticion a servidor Apache
        - si message es success regresar HTML home
        - si message es error 
            - hacer peticion de registro
                -si es success regresar HTML registered
                -si es error   regresar log de error
    */
    console.log("BODY");
    console.log(req.body);
    console.log('LOGIN');
    request(
        {
            url: "http://localhost/login.php", //URL to login
            method: "GET",
            qs: {username:req.body.name, password:req.body.password},
        },
        function (error, response, body) {
            if (error) {
                res.sendFile(
                    path.join(__dirname + "/public/error.html")
                );
            } else {
                let jsonResponse = JSON.parse(body)
                console.log(jsonResponse);
                if(jsonResponse.success===true)
                res.sendFile(path.join(__dirname + "/public/home.html"))
                else{
                    console.log('REGISTER');
                    request(
                        {
                            url: "http://localhost/register.php", //URL to register
                            method: "POST",
                            form:{username:req.body.name, password:req.body.password},
                        },
                        function (error, response, body) {
                            if (error) {
                                res.sendFile(
                                    path.join(__dirname + "/public/error.html")
                                );
                            } else {
                                let jsonResponse = JSON.parse(body)
                                console.log(jsonResponse);
                                jsonResponse.success?
                                res.sendFile(
                                    path.join(__dirname + "/public/registered.html")
                                ):
                                res.sendFile(
                                    path.join(__dirname + "/public/error.html")
                                );
                            }
                        }
                    )
                }
            }
        }
    );
});

app.listen(port, () => {
    console.log(`Example app listening at http://localhost:${port}`);
});
