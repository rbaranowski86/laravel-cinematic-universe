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

export const fetchCharactersByMovie = async (movieId:number, searchTerm = '') => {
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

export const deleteUniverse = async (universeId:number) => {
    try {
        const response = await fetch(`/api/cinematic-universes/${universeId}`, { method: 'DELETE' });

        if (response.status === 204) {
            return 'Universe successfully deleted';
        }

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }

        return response.json();
    } catch (error) {
        console.error(`Error while deleting universe:`, error);
        throw error;
    }
};

export const addUniverse = async (universeData: CinematicUniverse) => {
    const response = await fetch('/api/cinematic-universes', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(universeData),
    });
    return response.json();
};

export const editUniverse = async (universeId: number, universeData: CinematicUniverse) => {
    const response = await fetch(`/api/cinematic-universes/${universeId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(universeData),
    });
    return response.json();
};

