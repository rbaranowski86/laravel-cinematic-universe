// UniverseService.ts
import { CinematicUniverse, Movie, Character } from '../types';

const API_BASE_URL = '/api';

export const fetchCinematicUniverses = async (): Promise<CinematicUniverse[]> => {
    try {
        const response = await fetch(`${API_BASE_URL}/cinematic-universes`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return data.data;
    } catch (error) {
        console.error('Error while fetching cinematic universes:', error);
        throw error;
    }
};

export const fetchUniverseDetails = async (id: number): Promise<CinematicUniverse> => {
    try {
        const response = await fetch(`${API_BASE_URL}/cinematic-universes/${id}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return data.data;
    } catch (error) {
        console.error(`Error while fetching details for universe ${id}:`, error);
        throw error;
    }
};

export const fetchMoviesByUniverse = async (universeId: number): Promise<Movie[]> => {
    try {
        const response = await fetch(`${API_BASE_URL}/movies?universeId=${universeId}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return data.data;
    } catch (error) {
        console.error(`Error while fetching movies for universe ${universeId}:`, error);
        throw error;
    }
};

export const fetchMovieDetails = async (movieId: number): Promise<Movie> => {
    try {
        const response = await fetch(`${API_BASE_URL}/movies/${movieId}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        const data = await response.json();
        return data.data;
    } catch (error) {
        console.error(`Error while fetching details for movie ${movieId}:`, error);
        throw error;
    }
};

export const fetchCharactersByMovie = async (movieId, searchTerm = '') => {
    try {
        let url = `/api/characters?movieId=${movieId}`;
        if (searchTerm.trim() !== '') {
            url += `&search=${encodeURIComponent(searchTerm)}`;
        }

        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        const data = await response.json();
        return data.data; // Adjust based on your API response structure
    } catch (error) {
        console.error(`Error while fetching characters:`, error);
        throw error;
    }
};
