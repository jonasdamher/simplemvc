"use strict";

export default class Request {

  async get(url = '', data = {}) {
    data._token = '';
    const response = await fetch('/api/' + url, {
      method: 'POST',
      cache: 'no-cache',
      referrerPolicy: 'strict-origin',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
    return response.json();
  }

  async post(url = '', data = {}) {
    data._token = '';
    const response = await fetch('/api/' + url, {
      method: 'POST',
      cache: 'no-cache',
      referrerPolicy: 'strict-origin',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
    return response.json();
  }

  async delete(url = '', data = {}) {
    data._token = '';
    const response = await fetch('/api/' + url, {
      method: 'DELETE',
      cache: 'no-cache',
      referrerPolicy: 'strict-origin',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
    return response.json();
  }

  async patch(url = '', data = {}) {
    data._token = '';
    const response = await fetch('/api/' + url, {
      method: 'PATCH',
      cache: 'no-cache',
      referrerPolicy: 'strict-origin',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
    return response.json();
  }

  async put(url = '', data = {}) {
    data._token = '';
    const response = await fetch('/api/' + url, {
      method: 'PUT',
      cache: 'no-cache',
      referrerPolicy: 'strict-origin',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    });
    return response.json();
  }
}
