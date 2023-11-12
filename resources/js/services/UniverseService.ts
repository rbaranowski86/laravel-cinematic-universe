const API_BASE_URL = '/api';

export const fetchCinematicUniverses = async () => {
    try {
        const response = await fetch(`${API_BASE_URL}/cinematic-universes`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return await response.json();
    } catch (error) {
        console.error('Error while fetching cinematic universes:', error);
        throw error;
    }
};

export const fetchUniverseDetails = async (id: number) => {
    try {
        const response = await fetch(`${API_BASE_URL}/cinematic-universes/${id}`);
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return await response.json();
    } catch (error) {
        console.error(`Error while fetching details for universe ${id}:`, error);
        throw error;
    }
};
