package main

import (
    "fmt"
    "net/http"
)

func handler(w http.ResponseWriter, r *http.Request) {
	content := "Conected!"
	// r.URL.Path[1:]
    fmt.Fprintf(w, content)
}

func main() {
	fmt.Println("running")
    http.HandleFunc("/", handler)
    http.ListenAndServe(":80", nil)
}