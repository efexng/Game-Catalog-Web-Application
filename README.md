# Game Catalog Web Application

Welcome to the Game Catalog web application! This application allows you to browse a catalog of video games, view game details, and search for specific games.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
- [Usage](#usage)
- [Contributing](#contributing)
- [License](#license)
- [Acknowledgments](#acknowledgments)

## Getting Started

To get started with the Game Catalog web application, follow the instructions below.

### Prerequisites

Before you begin, ensure you have the following software installed:

- PHP
- MySQL
- A web server (e.g., Apache)

### Installation

1. Clone this repository to your local machine.

bash
git clone https://github.com/yourusername/game-catalog.git


2. Set up a MySQL database to store game information. You can import the provided SQL file to create the necessary tables.

bash
mysql -u yourusername -p yourdatabase < database.sql


3. Edit the database configuration in `config.php` with your database credentials.

php
$dbHost = 'your-database-host';
$dbName = 'your-database-name';
$dbUser = 'your-database-username';
$dbPass = 'your-database-password';


4. Place the project files in your web server's document root.

5. Open a web browser and access the web application:


http://localhost/game-catalog/index.php


## Usage

- Browse the list of games.
- Click on a game title to view its details.
- Use the search feature to find specific games.

## Contributing

We welcome contributions from the community. To contribute to the project, follow these steps:

1. Fork the repository.
2. Create a new branch for your feature: `git checkout -b feature-name`
3. Make your changes and commit them: `git commit -m 'Add new feature'`
4. Push to the branch: `git push origin feature-name`
5. Create a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Acknowledgments

We would like to thank the open-source community for their contributions and inspiration.
