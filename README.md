## Developers
Copyright 2015, Reid Baldwin & Tanner Heffner

# App
This to-do app is a continuation of the march16_todo repository with added database support.
We must have messed up git pull somewhere because we couldn't push back to that repo.
So this repo was created instead.

# PSQL stuff
CREATE DATABASE to_do;
\c to_do
CREATE TABLE tasks (id serial PRIMARY KEY, description varchar, category_id int);
CREATE TABLE categories (id serial PRIMARY KEY, name varchar);
ALTER TABLE tasks ADD duedate date;

# Licenses
Creative Commons
