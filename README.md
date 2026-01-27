              **Community Event Management Backend API – Updated README / Report**

 **Project Description**

This project is a **backend-only API system** built using **PHP and MySQL**.
It manages **community events**, where:

* **Organizers** can create, update, and delete events.
* **Members** can view events, join events, and leave events (remove participation).

The system provides **core backend services**:

* User management (registration, login, logout)
* Content management (events CRUD)
* Activity tracking (event participation CRUD)

> ⚠️ No user interface (UI) is included.
> All interactions are done through **browser-based API requests**.


 **System Roles**

 **Organizer**

* Register and login
* Create events
* Update events
* Delete events
* View event participants
* Remove participants

 **Member**

* Register and login
* View available events
* Join events
* Remove participation (optional)


 **Technologies Used**

* PHP (Core PHP)
* MySQL
* XAMPP (Apache & MySQL)
* Browser (for API testing)

 **Database Details**

**Database Name:** `event_system_db`

**Tables**

1. `users` – stores user accounts
2. `events` – stores event information
3. `event_participants` – tracks event participation

All tables are connected using **foreign keys**.

 **Project Folder Structure**

event_backend/
│
├── engine/
│   └── db.engine.php
│
├── services/
│   ├── account.service.php
│   └── event.service.php
│
├── http/
│   ├── account.http.php
│   └── event.http.php
│
├── index.php
└── README.md

 **How to Run the Project**

1. Copy the project folder into:
C:\xampp\htdocs\

2. Start **Apache** and **MySQL** from XAMPP Control Panel.
3. Create the database `event_system_db` and import SQL tables.
4. Open your browser and access Live :

https://mybackendproject.rf.gd

 **Browser API Testing Guide (CRUD included)**

> All API requests are tested directly through the browser.
> Follow the order below:


 **USER AUTHENTICATION TESTS**

**Register Organizer**

index.php?module=account&action=register&name=OrganizerOne&email=org@mail.com&password=123&role=organizer

✔ Inserts record into `users` table

**Register Member**

index.php?module=account&action=register&name=MemberOne&email=mem@mail.com&password=123&role=member

✔ Inserts another record into `users` table

**Login Organizer**

index.php?module=account&action=login&email=org@mail.com&password=123

✔ Session created for organizer

**Logout Organizer**

index.php?module=account&action=logout

✔ Session destroyed

 **EVENT MANAGEMENT TESTS (CRUD)**

**Login Organizer Again**

index.php?module=account&action=login&email=org@mail.com&password=123

**Create Event (C)**

index.php?module=event&action=create&title=Community Meetup&location=Dar%20es%20Salaam&date=2026-02-01

✔ Inserts record into `events` table
✔ Links event to organizer

**View Events List (R)**

index.php?module=event&action=list

✔ Displays all events with organizer names

**Update Event (U)**

index.php?module=event&action=update&event_id=1&title=Tech Meetup&location=Arusha&date=2026-02-10

✔ Updates event details

**Delete Event (D)**

index.php?module=event&action=delete&event_id=1

✔ Deletes event from `events` table

**Logout Organizer**

index.php?module=account&action=logout

**EVENT PARTICIPATION TESTS (CRUD)**

**Login Member**

index.php?module=account&action=login&email=mem@mail.com&password=123

**View Events**

index.php?module=event&action=list

✔ Member can see all events

**Join Event (C)**

index.php?module=event&action=join&event_id=1

✔ Inserts record into `event_participants` table

**View Event Participants (R)**

index.php?module=event&action=participants

✔ Displays list of members joined

**Remove Participant (D) – optional / Organizer endpoint**

index.php?module=event&action=remove-participant&event_id=1&member_id=2


✔ Deletes member participation

 **Security Considerations**

* Passwords are hashed with `password_hash()`
* Session-based authentication is enforced
* Role-based access control (`organizer` / `member`)
* Unauthorized access blocked


**Project Summary**

This backend system now **fully demonstrates CRUD**:

* **Events:** Create, Read, Update, Delete
* **Event Participants:** Create, Read, Delete
* User management: Create (register), Read (login), Logout

✔ Secure authentication
✔ Role-based access control
✔ Content creation and management
✔ Relational database design
✔ Browser-testable API endpoints

> The project satisfies academic requirements for **secure and scalable backend API design using PHP**.

✅ Browser Test URLs Summary

| Action             | URL                                                  | Role      |
| ------------------ | ---------------------------------------------------- | --------- |
| Register Organizer | `app.php?module=account&action=register&...`         | organizer |
| Register Member    | `app.php?module=account&action=register&...`         | member    |
| Login              | `app.php?module=account&action=login&...`            | all       |
| Logout             | `app.php?module=account&action=logout`               | all       |
| Create Event       | `app.php?module=event&action=create&...`             | organizer |
| Update Event       | `app.php?module=event&action=update&...`             | organizer |
| Delete Event       | `app.php?module=event&action=delete&...`             | organizer |
| List Events        | `app.php?module=event&action=list`                   | all       |
| Join Event         | `app.php?module=event&action=join&event_id=...`      | member    |
| View Participants  | `app.php?module=event&action=participants`           | all       |
| Remove Participant | `app.php?module=event&action=remove-participant&...` | organizer |

