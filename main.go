package main

import (
	"log"
	"net/http"

	"github.com/labstack/echo/v4"
	"github.com/labstack/echo/v4/middleware"
)

func main() {
	// Initialize Echo instance
	e := echo.New()

	// Middleware to log requests
	e.Use(middleware.Logger())
	e.Use(middleware.Recover())

	// Serve static files from public_html/assets
	e.Static("/assets", "public_html/assets")

	// Set login page as the root page
	e.File("/", "public_html/index.html")

	// Define routes for other HTML pages
	e.File("/home", "public_html/index.html")
	e.File("/explore", "public_html/explore.html")
	e.File("/journal", "public_html/journal.html")
	e.File("/contact", "public_html/contact.html")
	e.File("/map", "public_html/map.html")
	e.File("/explore-indonesia", "public_html/explore-indonesia.html")
	e.File("/news", "public_html/news.html")

	// Route for handling login form submission
	e.POST("/login", func(c echo.Context) error {
		// Retrieve form values
		username := c.FormValue("username")
		password := c.FormValue("password")

		// Basic authentication check (you can replace this with actual logic)
		if username == "admin" && password == "password" {
			// Redirect to index.html on successful login
			return c.Redirect(http.StatusSeeOther, "/home")
		}
		// Redirect back to login page if credentials are incorrect
		return c.String(http.StatusUnauthorized, "Login failed: invalid credentials")
	})

	// Start the server on port 80
	log.Println("Server started on :80")
	e.Logger.Fatal(e.Start(":80"))
}
