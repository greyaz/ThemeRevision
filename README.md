# ThemeRevision for Kanboard
![Release](https://img.shields.io/github/v/release/greyaz/ThemeRevision?color=%2332ab3d&style=flat-square)
![License](https://img.shields.io/github/license/greyaz/ThemeRevision?color=%233860f4&style=flat-square)
![Kanboard Support Good](https://img.shields.io/static/v1?label=Kanboard&message=%E2%89%A51.2.22%20Good&color=green&style=flat-square)
![Kanboard Support OK](https://img.shields.io/static/v1?label=Kanboard&message=%E2%89%A51.2.8%20OK&color=%23f7c400&style=flat-square)

ThemeRevision is a task-first and high quality theme for [Kanboard](https://github.com/kanboard/kanboard). It's also aimed at better mobile experiences, common plugins' compatibilities, and customization friendly.

## Screenshots
<img src="Screenshots/1.png" width="20%"> <img src="Screenshots/2.png" width="20%"> <img src="Screenshots/4.png" width="20%"> <img src="Screenshots/3.png" width="20%"> <img src="Screenshots/6.png" width="20%"> <img src="Screenshots/8.png" width="20%"> <img src="Screenshots/9.png" width="20%"> <img src="Screenshots/7.png" width="20%">

<img src="Screenshots/10.png" width="10%"> <img src="Screenshots/11.png" width="10%">

## Features
#### 1. Task-first
* ThemeRivision has been trying to create a high quality but minimalist UI, helps you focus on your tasks.

#### 2. Better mobile experiences
* Modern mobile application's interactive behaviour.

#### 3. Common plugins' compatibilities
* Calendar / Gantt / Group_assign / MetaMagic ...

#### 4. Dark mode

* Users can change the color scheme by themselves (User Profile -> Actions -> Theme Settings)
* Three modes provided: Light / Dark / Auto

#### 5. Customization friendly

* Structured CSS files, easy to locate elements.  
* Utilize "rem" as the global measuring unit.

## Installation
1. Install from the Kanboard plugin manager directly, or `git clone https://github.com/greyaz/ThemeRevision.git` into `your_kanboard_root/plugins`.
2. ThemeRevision use the file `favicon.png` in `your_kanboard_root/assets/img` as the head logo, replace it if needed.
3. **Optional:** Set the default task color to **grey** for better visual consistency. (Settings -> Project Setting)

## Customization
1. ***Make sure*** the folder `your_kanboard_root/plugins/ThemeRevision/Asset` is ***writable and executable***.
2. Rename the file `config-default.php` to `config.php`.
3. Enable "development mode" in the configuration file.
4. Edit raw CSS files in the folder `Asset/dev`.

## Author
- greyaz
- License MIT
