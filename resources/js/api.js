import axios from 'axios';
import router from './app.js';

const api = axios.create();

let isRefreshing = false; // Flag to indicate if token refresh is in progress
let failedRequests = []; // Queue to store failed requests while token is being refreshed

// Function to refresh token
function refreshToken() {
    isRefreshing = true;
    return axios.post('/api/auth/refresh', {}, {
        headers: {
            'Authorization': 'Bearer ' + localStorage.getItem('token')
        }
    })
        .then(response => {
            localStorage.setItem('token', response.data.token);
            // Retry all the failed requests
            failedRequests.forEach(callback => callback());
            failedRequests = [];
            return Promise.resolve();
        })
        .catch(error => {
            console.error(error);
            router.push('/noveo/login');
            return Promise.reject(error);
        })
        .finally(() => {
            isRefreshing = false;
        });
}

// REQUEST
api.interceptors.request.use(
    config => {
        if (localStorage.getItem('token')) {
            config.headers.authorization = 'Bearer ' + localStorage.getItem('token');
        }
        return config;
    },
    error => {
        return Promise.reject(error);
    }
);

// RESPONSE
api.interceptors.response.use(
    response => {
        if (localStorage.getItem('token')) {
            response.config.headers.authorization = 'Bearer ' + localStorage.getItem('token');
        }
        return response;
    },
    error => {
        if (error.response && error.response.status === 401 && !isRefreshing) {
            if (error.response.data.message === "Token has expired") {
                // If token has expired, refresh the token
                return refreshToken()
                    .then(() => {
                        // Retry the original request after token refresh
                        return api.request(error.config);
                    })
                    .catch(() => {
                        // If token refresh fails, redirect to login
                        return Promise.reject(error);
                    });
            }
            router.push('/noveo/login');
        } else if (error.response && error.response.status === 422) {
            // If response status is 422 (validation error), propagate the error to the component
            return Promise.reject(error);
        }
        return Promise.reject(error);
    }
);

export default api;
