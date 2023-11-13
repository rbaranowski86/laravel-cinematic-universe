import React, {useState, useEffect} from 'react';
import {useParams} from 'react-router-dom';
import {TextField, Table, TableBody, TableCell, TableContainer, TableHead, TableRow, Paper} from '@mui/material';
import {fetchMovieDetails, fetchCharactersByMovie} from '../services/UniverseService';
import {Movie, Character} from '../types';
import Dialog from '@mui/material/Dialog';
import DialogContent from '@mui/material/DialogContent';
import DialogTitle from '@mui/material/DialogTitle';
import {fetchActorInfoFromWikipedia} from '../services/WikipediaService';

const MoviePage: React.FC = () => {
    const {movieId} = useParams<{ movieId: string }>();
    const [movie, setMovie] = useState<Movie | null>(null);
    const [characters, setCharacters] = useState<Character[]>([]);
    const [searchTerm, setSearchTerm] = useState('');
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');
    const [openDialog, setOpenDialog] = useState(false);
    const [selectedActor, setSelectedActor] = useState(null);
    const [actorInfo, setActorInfo] = useState({name: '', image: '', description: ''});

    useEffect(() => {
        if (movieId) {
            const id = parseInt(movieId);
            fetchMovieDetails(id).then(movieData => {
                setMovie(movieData);
                setLoading(false);
            }).catch(err => {
                console.error(`Error while fetching details for movie ${id}:`, err);
                setError('Failed to load movie details');
                setLoading(false);
            });

            fetchCharacters(id, '');
        }
    }, [movieId]);

    const fetchCharacters = (id, searchTerm) => {
        fetchCharactersByMovie(id, searchTerm).then(charactersData => {
            setCharacters(charactersData);
        }).catch(err => {
            console.error(`Error while fetching characters for movie ${id}:`, err);
        });
    };

    const handleSearchChange = (event) => {
        setSearchTerm(event.target.value);
    };

    const handleSearch = () => {
        fetchCharacters(parseInt(movieId), searchTerm);
    };

    const handleActorClick = async (actorName) => {
        setOpenDialog(true);
        setSelectedActor(actorName);
        // Fetch actor info from Wikipedia (or another source) and set it in state
        const info = await fetchActorInfoFromWikipedia(actorName);
        setActorInfo(info);
    };
    const handleCloseDialog = () => {
        setOpenDialog(false);
        setSelectedActor(null);
        setActorInfo({name: '', image: '', description: ''});
    };

    const ActorInfoDialog = () => (
        <Dialog open={openDialog} onClose={handleCloseDialog}>
            <DialogTitle>{actorInfo.name}</DialogTitle>
            <DialogContent>
                <img src={actorInfo.image} alt={actorInfo.name}/>
                <p>{actorInfo.description}</p>
            </DialogContent>
        </Dialog>
    );

    if (loading) return <div>Loading...</div>;
    if (error) return <div>Error: {error}</div>;
    if (!movie) return <div>Movie not found</div>;

    return (
        <div>
            <h1>{movie.title}</h1>
            <p><strong>Release Date:</strong> {movie.releaseDate}</p>
            <p><strong>Director:</strong> {movie.director}</p>
            <p><strong>Box Office Earnings:</strong> ${movie.boxOfficeEarnings.toLocaleString()}</p>

            <h2>Characters</h2>
            <TextField
                label="Search Characters"
                variant="outlined"
                value={searchTerm}
                onChange={handleSearchChange}
                onKeyPress={(e) => e.key === 'Enter' && handleSearch()}
            />
            <TableContainer component={Paper}>
                <Table aria-label="characters table">
                    <TableHead>
                        <TableRow>
                            <TableCell>Name</TableCell>
                            <TableCell>Alias</TableCell>
                            <TableCell>Actor</TableCell>
                            <TableCell>Superpowers</TableCell>
                            <TableCell>First Appearance</TableCell>
                        </TableRow>
                    </TableHead>
                    <TableBody>
                        {characters.map((character) => (
                            <TableRow key={character.id}>
                                <TableCell>{character.name}</TableCell>
                                <TableCell>{character.alias || 'N/A'}</TableCell>
                                <TableCell style={{cursor: 'pointer', textDecoration: 'underline', color: 'blue'}}
                                           onClick={() => handleActorClick(character.actor?.name)}>
                                    {character.actor?.name || 'N/A'}
                                </TableCell>
                                <TableCell>{character.superpowers || 'N/A'}</TableCell>
                                <TableCell>{character.firstAppearance || 'N/A'}</TableCell>
                            </TableRow>
                        ))}
                    </TableBody>
                </Table>
            </TableContainer>
            <ActorInfoDialog/>
        </div>
    );
};

export default MoviePage;
