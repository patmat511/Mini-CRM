# Mini CRM System

This project is a **Customer Relationship Management (CRM)** system designed to manage customer information, track sales deals, and handle employee roles within the organization. The system's database structure is defined using **DBML** (Database Markup Language).

## Project Overview

The CRM system stores and organizes data related to customers, employees, and sales deals. It allows for:
- Managing customer contact details.
- Tracking deals made with customers, including deal stages and associated sales representatives.
- Defining employee roles to manage permissions and responsibilities.
- Handling sales pipeline stages for each deal.

### Key Features
- **Customer Management**: Store and organize customer information (name, contact details, address).
- **Employee Management**: Manage employee roles, track login credentials (hashed password).
- **Deal Management**: Track sales deals associated with customers and employees, including deal status.
- **Stage Management**: Define different stages in the sales process for each deal.

## Database Structure

### Database Diagram

Below is the diagram of the database schema for the CRM system:

![image](https://github.com/user-attachments/assets/afde6407-097a-4abd-aa4e-42e36065c141)

## Home Page
![image](https://github.com/user-attachments/assets/230d0ddd-b798-4ba6-86d1-d266238303ab)

## CRUD Operations
![image](https://github.com/user-attachments/assets/17092b12-eef5-41b9-a495-5edf99514308)


## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/patmat511/Mini-CRM.git
   ```
2. After cloning the repository, make sure that the .env file is in the root directory.
   
   In the .env file, configure the DATABASE_URL to point to your database.
```env
  DATABASE_URL="mysql://root:ChangeMe@127.0.0.1:3307/mini_crm"
```

